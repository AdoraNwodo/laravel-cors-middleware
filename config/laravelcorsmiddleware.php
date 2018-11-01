<?php

return [
    
    /*
	*  __________      __________       ___________     __________
	* |               |          |     |           |   |
	* |               |          |     |           |   |
	* |               |          |     |           |   |
	* |               |          |     |___________|   |__________
	* |               |          |     |       \                  |
	* |               |          |     |        \                 |
	* |               |          |     |         \                |
	* |__________     |__________|     |          \    ___________|
	*
	*
	*
	* LARAVEL CORS MIDDLEWARE
	* 
	* Please add a list of values to allowedOrigins, allowedMethods and allowedHeaders. 
	* You can also choose to set the value of these to '*', but note that this is not advisable 
	* for allowedOrigins as this would give everyone access to your api.
    */

    'allowCredentials' => true,	  //true or false.      NOTE: Boolean NOT String. 'true' is different from true
    'allowedOrigins' => ['*'],    //array of strings    e.g. ['*'] or ['https://mywebsite.com', 'https://anotherwebsite.com', ... ]
    'allowedMethods' => ['*'],    //array of strings    e.g. ['*'] or ['GET', 'POST', ... ]
    'allowedHeaders' => ['*'],    //array of strings.   e.g. ['*'] or ['Content-Type', 'Authorization', ... ]
    'maxAge' => 0,                //number.             e.g. 86400
];