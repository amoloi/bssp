<?php
/**
 * Description of JBlac_Restrict_Acl
 *
 * @author Innocent J Blac
 */
class JBlac_Restrict_Acl extends Zend_Acl{
    public function __construct()
    {
        // Add a new role called "guest"
        $this->addRole(new Zend_Acl_Role('guest'));
        // Add a new role called "user",which inherits from guest
        $this->addRole(new Zend_Acl_Role('user') , 'guest');        
        // Add a role called commitee, which inherits from user
        $this->addRole(new Zend_Acl_Role('commitee'), 'user');
        // Add a role called admin, which inherits from commitee
        $this->addRole(new Zend_Acl_Role('admin'), 'commitee');

         // Default Resources
        $this->add(new Zend_Acl_Resource('default::index'));
        $this->add(new Zend_Acl_Resource('default::error'));
        $this->add(new Zend_Acl_Resource('default::services'));
        
         // Budgets Resources
        $this->add(new Zend_Acl_Resource('budgets::index'));
        $this->add(new Zend_Acl_Resource('budgets::create'));
        $this->add(new Zend_Acl_Resource('budgets::update'));

         // Commitee Resolutions Resources
        $this->add(new Zend_Acl_Resource('commiteeresolutions::index'));
        $this->add(new Zend_Acl_Resource('commiteeresolutions::create'));
        $this->add(new Zend_Acl_Resource('commiteeresolutions::update'));
        $this->add(new Zend_Acl_Resource('commiteeresolutions::commitee-resolutions'));
        $this->add(new Zend_Acl_Resource('commiteeresolutions::details'));
        $this->add(new Zend_Acl_Resource('commiteeresolutions::payments'));
        $this->add(new Zend_Acl_Resource('commiteeresolutions::consultants'));
        
         // Consultants Resources
        $this->add(new Zend_Acl_Resource('consultants::index'));
        $this->add(new Zend_Acl_Resource('consultants::create'));
        $this->add(new Zend_Acl_Resource('consultants::update'));

         // Contact Resources
        $this->add(new Zend_Acl_Resource('contacts::index'));
        $this->add(new Zend_Acl_Resource('contacts::create'));
        $this->add(new Zend_Acl_Resource('contacts::update'));



         // Extensions Resources
        $this->add(new Zend_Acl_Resource('extensions::index'));
        $this->add(new Zend_Acl_Resource('extensions::create'));
        $this->add(new Zend_Acl_Resource('extensions::update'));

         // Home Resources
        $this->add(new Zend_Acl_Resource('home::index'));
       
         // Login Resources
        $this->add(new Zend_Acl_Resource('login::index'));
        $this->add(new Zend_Acl_Resource('login::reset-password'));
        $this->add(new Zend_Acl_Resource('login::error'));
        
        

         // Payments Resources
        $this->add(new Zend_Acl_Resource('payments::index'));
        $this->add(new Zend_Acl_Resource('payments::create'));
        $this->add(new Zend_Acl_Resource('payments::update'));        
        
         // Projects Resources
        $this->add(new Zend_Acl_Resource('projects::index'));
        $this->add(new Zend_Acl_Resource('projects::create'));
        $this->add(new Zend_Acl_Resource('projects::update'));         
        $this->add(new Zend_Acl_Resource('projects::commitee-resolutions'));
        $this->add(new Zend_Acl_Resource('projects::consultants'));
        $this->add(new Zend_Acl_Resource('projects::payments'));
        $this->add(new Zend_Acl_Resource('projects::composition')); 
        
         // Promoters Resources
        $this->add(new Zend_Acl_Resource('promoters::index'));
        $this->add(new Zend_Acl_Resource('promoters::create'));
        $this->add(new Zend_Acl_Resource('promoters::update'));         
        $this->add(new Zend_Acl_Resource('promoters::details'));
        $this->add(new Zend_Acl_Resource('promoters::request-details'));
        
         // Search Resources
        $this->add(new Zend_Acl_Resource('search::index'));
        $this->add(new Zend_Acl_Resource('search::applications'));
        $this->add(new Zend_Acl_Resource('search::commitee-resolutions'));         
        $this->add(new Zend_Acl_Resource('search::consultants'));
        $this->add(new Zend_Acl_Resource('search::projects'));
        $this->add(new Zend_Acl_Resource('search::budgets'));
        

         // Service Resources
        $this->add(new Zend_Acl_Resource('service::index'));

        
         // Users Resources
        $this->add(new Zend_Acl_Resource('users::index'));
        $this->add(new Zend_Acl_Resource('users::create'));
        $this->add(new Zend_Acl_Resource('users::update'));         
        $this->add(new Zend_Acl_Resource('users::permissions'));
        
        // Allow guests to see the error, login and index pages
        

        $this->allow('guest' ,'login::index' , [
            'index',
            'login',
            'logout'
        ]);

        $this->allow('user' ,'login::reset-password' , [
            'index',
        ]);        
        
        $this->allow('user' ,'default::index' , [
            'index',
        ]);
        
        $this->allow('user' ,'default::error' , [
            'error',
            'access-denied',
            'authentication-required',
            'parameters-missing',
        ]);
        $this->allow('user' ,'default::services' , [
            'error',
            'new-instalment',
            'get-towns',
            'get-constituences',
            'new-extension',
            'new-employment-data',
            'entityform',
            'new-request',
            'remove-request',
            'new-project-budget',
            'create-project-budget',
            'new-legal-entity',
            'create-legal-entity',
            'create-project-budget',
            'fetch-sector-priority-areas',
            'new-contact',
            'remove-contact',
            'fetch-new-applications-count',
            'fetch-new-committee-resolution-count',
            'fetch-new-projects-count',
        ]);

        $this->allow('user' ,'promoters::index' , [
            'index',
        ]);
        
        $this->allow('user' ,'promoters::create' , [
            'index',
            'create',
            'delete',
            'delete-request',
        ]);         
        
        $this->allow('user' ,'promoters::update' , [
            'index',
        ]);           
        
        $this->allow('user' ,'promoters::details' , [
            'index',
        ]);
        $this->allow('user' ,'promoters::request-details' , [
            'index',
        ]);
        
        $this->allow('user' ,'users::update' , [
            'profile-update',            
        ]);        

        /**
         * Commitee
         */

        $this->allow('commitee' ,'budgets::index' , [
            'index',
            'create',
        ]);         
        $this->allow('commitee' ,'budgets::update' , [
            'index',
        ]);
        $this->allow('commitee' ,'budgets::create' , [
            'index',
            'delete',
        ]);        
        
        $this->allow('commitee' ,'commiteeresolutions::index' , [
            'index',
        ]);        
        $this->allow('commitee' ,'commiteeresolutions::commitee-resolutions' , [
            'index',
            'create',
            'resolution-info',
        ]);          
        
        $this->allow('commitee' ,'commiteeresolutions::consultants' , [
            'index',
            'create',
        ]);
        $this->allow('commitee' ,'commiteeresolutions::create' , [
            'index',
            'create',
            'delete'
        ]);         
        $this->allow('commitee' ,'commiteeresolutions::details' , [
            'index',
        ]);        
        
        $this->allow('commitee' ,'commiteeresolutions::payments' , [
            'index',
            'create',
        ]);         
        $this->allow('commitee' ,'commiteeresolutions::update' , [
            'index',
        ]);         
        
        /**
         * Consultants
         */
        
        $this->allow('commitee' ,'consultants::index' , [
            'index',
            'create',
        ]);         
        $this->allow('commitee' ,'consultants::update' , [
            'index',
            'update',
        ]);
        $this->allow('commitee' ,'consultants::create' , [
            'index',
            'delete',
        ]);
        
        /**
         * Contacts
         */
        $this->allow('commitee' ,'contacts::index' , [
            'index',
        ]);
        $this->allow('commitee' ,'contacts::update' , [
            'index',
        ]);        
        $this->allow('commitee' ,'contacts::create' , [
            'index',
            'delete',
        ]);
        
        /**
         * Extensions
         */
        $this->allow('commitee' ,'extensions::index' , [
            'index',
            'create',
        ]);        
        $this->allow('commitee' ,'extensions::create' , [
            'index',
            'delete',
        ]);
        $this->allow('commitee' ,'extensions::update' , [
            'index',
        ]);
        
        /**
         * Projects
         */
        $this->allow('commitee' ,'projects::index' , [
            'index',
        ]);
        $this->allow('commitee' ,'projects::create' , [
            'index',
            'delete',
        ]);
        $this->allow('commitee' ,'projects::consultants' , [
            'index',
            'create',
        ]);
        $this->allow('commitee' ,'projects::composition' , [
            'index',
            'update',
            'delete',
        ]);
        $this->allow('commitee' ,'projects::commitee-resolutions' , [
            'index',
            'create',
            'resolution-info'
        ]);        
        $this->allow('commitee' ,'projects::payments' , [
            'index',
        ]);         
        $this->allow('commitee' ,'projects::payments' , [
            'create',
        ]);
        
        $this->allow('commitee' ,'projects::update' , [
            'index',
        ]);
        
        /**
         * Search
         */
        $this->allow('commitee' ,'search::index' , [
            'index',
        ]);
        
        $this->allow('commitee' ,'search::applications' , [
            'index',
        ]);
        $this->allow('commitee' ,'search::budgets' , [
            'index',
        ]);
        $this->allow('commitee' ,'search::commitee-resolutions' , [
            'index',
        ]);
        $this->allow('commitee' ,'search::consultants' , [
            'index',
        ]);
        $this->allow('commitee' ,'search::projects' , [
            'index',
        ]);
        
        /**
         * Users
         */
        $this->allow('admin' ,'users::index' , [
            'index',
        ]);
        $this->allow('admin' ,'users::create' , [
            'index',
            'delete',
        ]);
        $this->allow('admin' ,'users::update' , [
            'index',           
        ]);
        
//        $this->deny('commitee' , 'promoters::index' , 'index');
        $this->allow('admin' , 'promoters::index' , 'index');
        $this->deny('user' , 'budgets::index' , 'index');
        $this->deny('admin' , 'login::index' , 'index');

        // Other definitions
    }
}
