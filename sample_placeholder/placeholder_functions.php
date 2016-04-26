<?php
// Functions for the placeholder
// Filter
function sample_placeholder_filter($content) {
  // Form a reugular expression that matches accordingly:
  // (%               start of the placeholder
  //   placeholder      name of our matching placeholder
  //   (.*)             arbitrary string (will be parsed into parameters)
  // %)               end of the placeholder
  $placeholder = '/\(% placeholder(.*)%\)/';

  // Call preg_replace_callback with a callback that will do the replacements
  $callback = 'sample_placeholder_content_callback';

  return preg_replace_callback($placeholder, $callback, $content);
}

// Callback to return the placeholder output
function sample_placeholder_content_callback($matches) {
  // $matches[1] contains the match from (.*) in our regular expression
  // We process this string into the corresponding parameters
  $params = sample_placeholder_process_params($matches[1]);

  // Then call the output function with these parameters
  return sample_placeholder_get_output($params, false);
}

// Processes a string into an array of parameters to be passed to get_output
function sample_placeholder_process_params($string) {
  // Initialize the array
  $params = array();

  // Split up the string according to the delimiter "|"
  $_params = explode('|', $string);

  // Loop through each segment (which should be of the form 'name=value')
  foreach ($_params as $_param) {
    // Split the segment into the name and value
    $param = explode('=', $_param);

    // If there is indeed a name and a value, trim off the trailing spaces and ""
    if (isset($param[1])) {
      $name = trim($param[0], ' "');
      $value = trim($param[1], ' "');
      $params[$name] = $value;
    }
  }

  // Return the processed parameters
  return $params;
}

// Builds the output given the parameters
function sample_placeholder_get_output($params, $echo = true) {
  // Validate the input parameters
  $params = sample_placeholder_validate_params($params);

  // Start building the output string
  // In this example, we will build an unordered list that outputs "Hello World"
  // $params['repeat'] number of times, and with a font size of $params['size']
  $output  = '<ul class="placeholder">';

  for ($i = 0; $i < $params['repeat']; $i++) {
    $output .= '<li style="font-size: ' . $params['size'] . 'px">' . sample_placeholder_i18n('HELLO_WORLD') . '</li>';
  }

  $output .= '</ul>';

  // The $echo parameter sets whether the content is printed or not
  // This allows admins to call your function in their themes with just $params
  // specified and still have the content printed (rather than manually needing
  // to call echo beforehand)
  if ($echo) {
    echo $output;
  } else {
    return $output;
  }
}

// Validate the input parameters to get_output
function sample_placeholder_validate_params($params = array()) {
  // Set some default parameters
  $default = array(
    'repeat' => 5,
    'size'   => '10',
  );

  // Merge them with the $params array
  $params = array_merge($default, $params);

  // Do any further validation
  // In this example, we ensure that @repeat and @size are positive integers
  $params['repeat'] = abs((int) $params['repeat']);
  $params['size'] = abs((int) $params['size']);

  // Return the new $params array
  return $params;
}