<?php

class Login_Form_ResetPassword extends JBlac_Form
{
    private $requiredFieldsDecorators = [
    'ViewHelper',
    ['Label', ['requiredSuffix' => ' *']],
];
    public function init()
    {
        $this->setAttrib('class', 'form-reset-password');
        
        $password = $this->addElement('password', 'password', [
                                                                'filters' => ['StringTrim' , 'StripTags'],
                                                                'validators' => [
                                                                ['NotEmpty'],
                                                                ['StringLength', false, [6, 18]],
                                                                ],
                                                                'class' => 'form-control',
                                                                'required' => true,
                                                                'label' => 'Password',
                                                               ]);


        $password_confirm = $this->addElement('password', 'password_confirm', [
                                                                                'filters' => ['StringTrim' ,'StripTags'],
                                                                                'validators' =>[
                                                                                ['Identical' , FALSE , [
                                                                                    'token' => 'password' ,
                                                                                    'messages' => [
                                                                                    Zend_Validate_Identical::NOT_SAME => 'Passwords do not match'
                                                                                    ]
                                                                                ]],
                                                                                ['Alnum'],
                                                                                ['StringLength', false, [6, 18]],
                                                                                ],
                                                                                'class' => 'form-control',
                                                                                'required' => true,
                                                                                'label' => 'Confirm Password',
                                                                               ]);
        
        $button = new Zend_Form_Element_Button('cmdsave');
        
        $button->setLabel('Sign In')
                ->setAttribs(array(
                    'class' => 'btn btn-lg btn-primary btn-block',
                    'type' => 'submit'
                ));
        
                $this->addElements(array(
                    $password,
                    $password_confirm,
                    $button,
                ));
    }


}

