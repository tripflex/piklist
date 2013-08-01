
<p class="piklist-demo-help-source">
  <strong><?php printf(__('The code that built this <em>%1$s</em> can be found in: ', 'piklist'), $type); ?></strong>
  <br />
  <code><?php echo str_replace(ABSPATH, '', $location); ?></code>
</p>