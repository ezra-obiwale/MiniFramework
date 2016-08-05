#Mini Framework

This is a simple and basic MVC framework for a single point of entry system.

##File Structure

> - Mini Framework/
>  |
>  | - core/								/* Contains required classes for the framework to function */
>  |   |
>  |   | - ErrorCatcher.php					/* Catches the caught exception errors and ensures they are well and always displayed */
>  |   |
>  |   | - Layout.php						/* Loads layouts. */
>  |   |
>  |   | - Request.php						/* Parses the request recieved */
>  |   |
>  |   | - Response.php						/* Prepares the response to the request */
>  |   |
>  |   | - System.php						/* Allows interaction with the framework e.g. config */
>  |   | 
>  |   | - Util.php							/* Util functions */
>  |   |
>  | - module/								/* Your modules go here */
>  |   |
>  |   | - Guest/							/* An example module */
>  |   |   |
>  |   |   | - Controller/					/* Your controllers should always be in the "Controller" directory */
>  |   |   |   |
>  |   |   |   | - Page.php					/* An example controller */
>  |   |   |
>  |   |   | - Layout/						/* Your layout (phtml) files go here */
>  |   |   |   |
>  |   |   |   | - page/					/* The Page controller layouts directory */
>  |   |   |   |   |
>  |   |   |   |   | - home.phtml		/* An action (method) of the Page controller's layout file */
>  |   |   |   |   |
>  |   |   |   | - errors.phtml				/* The default error file for the module */
>  |   |   |   |
>  |   |   |   + model/						/* Your model classes go here */
>  |   |   |   |
>  | - public/								/* The directory exposed to the public */
>  |   |
>  |   | -index.php							/* The single access point */
>  |   |
>  | + vendor/								/* Third-party libraries go here */
>  |
>  | - .htaccess							/* Redirect queries to the single access point */
>  |
>  | - config.php							/* Configurations for the framework */
>  |
>  | - init.php								/* Initializes the engine */
>  |
>  | - README.md							/* This file */

##Usage

1.	**Open up the config.php file**
	-	_Set up your database access information:_ There are two options **_development_** and **_production_**.
		In the **_development_** mode, errors are displayed while in the **_production_** mode, errors are hidden
	-	_Set up your defaults:_ Three defaults are required **_module_**, **_controller_**, and **_action_**, which are the default module, controller and action respectively to call if any of them is not specified.
		**NOTE**: The default controller will be looked for in ANY module that is called without a controller, not just the default **_module_** alone.
	-	_Autoload directories:_ If you have classes in directories other than **_access_**, **_model_** or **_vendor_**, you should add the full path to such directories here. If you would like to a constant defined to hold the path, make the intended constant the key, preferrably in uppercase. Exceptions include ACCESS, BASE, CORE, LAYOUT, MODEL, VENDOR, ROOT and any other PHP defined contants.
2.	**Add vendors** [optional]
		Your vendors, if any, should go into the **_vendor_** directory
3.	**Create controllers**
		These go into the **_access_** directory. The name of each file **MUST** be the same as the name of the contained class.
4.	**Create models** _[optional]_
		Your models can actually reside anywhere in as much as the directory as been registered in the config (if custom). For structural and maintenance reasons, they should go into the **_model_** directory.
		
##Attention!!!

Module classes are expected to be namespaced in the format [module]\[directory]. For example, controllers in a **_User_** module would be namespaced **_User\Controller_** while the models would be namespaced **_User\Model_**.