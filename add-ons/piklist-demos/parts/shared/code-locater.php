
<h4><?php printf(__('The code that built this %1$s can be found here:','piklist'), $type);?></h4>

<code><?php echo str_replace(ABSPATH, '', $location); ?></code>