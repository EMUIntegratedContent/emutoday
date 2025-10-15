<?php

/**
 * Created Sept 2, 2025 to replace the deprecated subfission/cas package with a custom Cas service, service provider, and facade.
 */

namespace Emutoday\Services;

use phpCAS;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Class CasService
 * @package Emutoday\Services
 * Custom CAS authentication service using apereo/phpcas
 */
class CasService
{
    protected $config;
    protected $initialized = false;

    public function __construct()
    {
        $this->config = config('cas');
    }

    /**
     * Initialize phpCAS with configuration
     */
    protected function initialize()
    {
        if ($this->initialized) {
            return;
        }

        // Set debug mode using modern logging
        if ($this->config['cas_debug']) {
            $this->setupLogging();
        }

        // Set verbose errors
        if ($this->config['cas_verbose_errors']) {
            phpCAS::setVerbose(true);
        }

        // Initialize phpCAS client
        $version = $this->getCasVersion();
        $serviceBaseUrl = $this->getServiceBaseUrl();

        // Debug logging
        if ($this->config['cas_debug']) {
            error_log("CAS Service URL: " . $serviceBaseUrl);
        }

        phpCAS::client($version, $this->config['cas_hostname'], $this->config['cas_port'], $this->config['cas_uri'], $serviceBaseUrl);

        // Handle SSL validation
        $this->handleSslValidation();

        // Handle SAML
        if ($this->config['cas_enable_saml']) {
            phpCAS::setServerLoginURL($this->config['cas_login_url']);
        }

        // Handle proxy
        if ($this->config['cas_proxy']) {
            phpCAS::setServerProxyValidateURL($this->config['cas_proxy']);
        }

        // Handle session control
        /**
         * With the current configuration (cas_control_session = false), Laravel manages the authentication sessions, and phpCAS will now automatically strip the ticket parameter from the URL after successful authentication. This is the standard and secure behavior you want.
         * The ticket will still be present during the authentication process, but it will be removed from the URL once the authentication is complete and the user is redirected to their destination page.
         */
        if (!$this->config['cas_control_session']) {
            // When Laravel controls sessions, allow phpCAS to clear tickets from URL
            // This prevents the ticket parameter from appearing in the URL after authentication
        } else {
            // When phpCAS controls sessions, prevent clearing tickets from URL
            phpCAS::setNoClearTicketsFromUrl();
        }

        $this->initialized = true;
    }

    /**
     * Setup modern logging for phpCAS
     */
    protected function setupLogging()
    {
        $logPath = is_string($this->config['cas_debug'])
            ? $this->config['cas_debug']
            : storage_path('logs/phpcas.log');

        $logger = new Logger('phpCAS');
        $logger->pushHandler(new StreamHandler($logPath, Logger::DEBUG));

        phpCAS::setLogger($logger);
    }

    /**
     * Get the service base URL for CAS
     */
    protected function getServiceBaseUrl()
    {
        // Use configured service URL or default to callback route
        if (!empty($this->config['cas_client_service'])) {
            return $this->config['cas_client_service'];
        }

        // Default to callback route
        return request()->getSchemeAndHttpHost() . '/cas/callback';
    }

    /**
     * Get CAS version constant
     */
    protected function getCasVersion()
    {
        switch ($this->config['cas_version']) {
            case '1.0':
                return CAS_VERSION_1_0;
            case '2.0':
                return CAS_VERSION_2_0;
            case '3.0':
                return CAS_VERSION_3_0;
            case 'SAML':
                return SAML_VERSION_1_1;
            default:
                return CAS_VERSION_2_0;
        }
    }

    /**
     * Handle SSL validation configuration
     */
    protected function handleSslValidation()
    {
        switch ($this->config['cas_validation']) {
            case 'self':
                phpCAS::setNoCasServerValidation();
                break;
            case 'ca':
                if (!empty($this->config['cas_cert'])) {
                    phpCAS::setCasServerCACert($this->config['cas_cert'], $this->config['cas_validate_cn']);
                }
                break;
            default:
                phpCAS::setNoCasServerValidation();
                break;
        }
    }

    /**
     * Check if user is authenticated
     */
    public function isAuthenticated()
    {
        $this->initialize();

        // Handle masquerading for development
        if (!empty($this->config['cas_masquerade'])) {
            return true;
        }

        return phpCAS::isAuthenticated();
    }

    /**
     * Authenticate user
     */
    public function authenticate()
    {
        $this->initialize();

        // Handle masquerading for development
        if (!empty($this->config['cas_masquerade'])) {
            return;
        }

        phpCAS::forceAuthentication();
    }

    /**
     * Get authenticated user
     */
    public function user()
    {
        $this->initialize();

        // Handle masquerading for development
        if (!empty($this->config['cas_masquerade'])) {
            return $this->config['cas_masquerade'];
        }

        if (phpCAS::isAuthenticated()) {
            return phpCAS::getUser();
        }

        return null;
    }

    /**
     * Get user attributes (SAML)
     */
    public function getAttributes()
    {
        $this->initialize();

        // Handle masquerading for development
        if (!empty($this->config['cas_masquerade'])) {
            return null;
        }

        if (phpCAS::isAuthenticated() && $this->config['cas_enable_saml']) {
            return phpCAS::getAttributes();
        }

        return null;
    }

    /**
     * Logout user
     */
    public function logout($url = null)
    {
        $this->initialize();

        // Handle masquerading for development
        if (!empty($this->config['cas_masquerade'])) {
            echo "Masquerading for development as " . $this->config['cas_masquerade'] . ". No logout performed.";
            return;
        }

        if ($url) {
            phpCAS::logoutWithRedirectService($url);
        } else {
            phpCAS::logout();
        }
    }

    /**
     * Get logout URL
     */
    public function getLogoutUrl()
    {
        return $this->config['cas_logout_url'];
    }

    /**
     * Get login URL
     */
    public function getLoginUrl()
    {
        $this->initialize();
        return phpCAS::getServerLoginURL();
    }
}
