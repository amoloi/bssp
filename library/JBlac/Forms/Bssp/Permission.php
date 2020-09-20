<?php

class JBlac_Forms_Bssp_User extends JBlac_Form
{
    
    public function init()
    {    
        $id = new Zend_Form_Element_Hidden('id');
        $id->removeDecorator('Label');
        
        $this->addElement($id);

        $name = new Zend_Form_Element_Text('firstname');
        $name->setLabel('First Name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter first name',
                    'maxlength' => 80,
                    'required' => 'required'
                ))
                ->setRequired(TRUE)
                ->addFilter('StripTags')
                ->addFilter('stringTrim');
        
        $this->addElement($name);

        $lastname = new Zend_Form_Element_Text('lastname');
        $lastname->setLabel('Last Name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter last name',
                    'required' => 'required',
                    'maxlength' => 80,
                ))
                ->setRequired()
                ->addFilter('StripTags')
                ->addFilter('stringTrim');
        
        $this->addElement($lastname);

        
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('E-mail Address')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter e-mail address',
                    'maxlength' => 128,
                    'required' => 'required',
                ))
                ->setRequired()
                ->addFilter('StripTags')
                ->addFilter('stringTrim')                
                ->addValidator('Db_NoRecordExists' , FALSE , [
                    'table' => 'users',
                    'field' => 'email',
                ]);
        
        $this->addElement($email);        

        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('User Name')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter user name',
                    'maxlength' => 40,
                    'required' => 'required',
                ))
                ->setRequired()
                ->addFilter('StripTags')
                ->addFilter('stringTrim')                
                ->addValidator('Db_NoRecordExists' , FALSE , [
                    'table' => 'users',
                    'field' => 'username',
                ]);
        
        $this->addElement($username);         
        
        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter password',
                    'maxlength' => 40,
                    'required' => 'required',
                ))
                ->setRequired();
        
        $this->addElement($password);
        
        
        $role = new Zend_Form_Element_Select('role');
        $role->setLabel('Role');
        $lov = JBlac_Utilities_Project::getUserRoles();

        $role->setMultiOptions($lov)
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ))
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('stringTrim');
        
        $this->addElement($role);       
                                      
    }
}