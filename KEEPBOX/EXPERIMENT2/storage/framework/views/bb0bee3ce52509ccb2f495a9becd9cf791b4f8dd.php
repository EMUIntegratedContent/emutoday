<!doctype html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $__env->yieldContent('title', 'EMU Today'); ?></title>
  <link rel="stylesheet" href="/css/foundation.css" />
  <link rel="stylesheet" href="/css/app.css" />
  <script src="/js/vendor/modernizr.js"></script>
  <?php echo $__env->yieldContent('meta'); ?>
</head>
<body>
  <?php echo $__env->make('public.layouts.connection-bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php echo $__env->yieldContent('content'); ?>
  <?php echo $__env->make('public.layouts.base-bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <!-- javascripts below -->
  <script type="text/javascript" src="/js/vendor/jquery.js"></script>
  <script type="text/javascript" src="/js/foundation.min.js"></script>
  <script type="text/javascript"> $(document).foundation(); </script>
  <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
