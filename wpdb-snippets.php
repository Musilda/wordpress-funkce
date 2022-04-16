<?php

//Select - prepare
global $wpdb;
$table   = $wpdb->prefix . 'custom_table';
$query   = $wpdb->prepare( "SELECT * FROM $table ORDER BY ID DESC LIMIT %d OFFSET %d", array( 10, $start ) );
$results = $wpdb->get_results( $query );

//Select - get result
global $wpdb;
$table = $wpdb->prefix . 'custom_table';
$query = $wpdb->get_results( "SELECT * FROM $table ORDER BY ID DESC LIMIT 10 OFFSET " . $start );

//Insert
global $wpdb;
$wpdb->insert(
	$wpdb->prefix . 'custom_table',
	array(
	       'first_name' 	=> $first_name,
		'last_name' 	=> $last_name,
		'email' 	=> $email,
		'subject' 	=> $subject,
	  'message' 	=> $message,
	 )
);

//Update
global $wpdb;
$wpdb->update(
	$wpdb->prefix . 'custom_table',
	array(
	       'first_name' 	=> $first_name,
		'last_name' 	=> $last_name,
		'email' 	=> $email,
		'subject' 	=> $subject,
		'message' 	=> $message,
	),
        array( 
                'ID' => $id 
        )
);
