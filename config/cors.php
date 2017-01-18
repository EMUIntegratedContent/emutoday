<?php

/**
 *  Added by Chris Puzzuoli, 12/21/16. Allows API endpoints to be accessible
 *  from other domains (such as emich.edu)
 */

 return [
     /*
     |--------------------------------------------------------------------------
     | Laravel CORS
     |--------------------------------------------------------------------------
     |

     | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
     | to accept any value.
     |
     */
    'supportsCredentials' => false,
    'allowedOrigins' => ['http://www.emich.edu', 'https://www.emich.edu', 'http://webstage.emich.edu', 'https://webstage.emich.edu'],
    'allowedHeaders' => ['*'], // ex : ['Content-Type', 'Accept']
    'allowedMethods' => ['GET', 'POST'], // ex: ['GET', 'POST', 'PUT',  'DELETE']
    'exposedHeaders' => [],
    'maxAge' => 3600,
    'hosts' => [],
];
