When using partials inside a template, you can use the function:
```
get_template_part( 'partials/featured-image', null, array( 
  'class' => 'featured-home',
  'data'  => array(
    'size' => 'large',
    'is-active' => true,
  )) 
);
```
