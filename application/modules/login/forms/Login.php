<?php
/**
 * Login_Form_Login
 * 
 * @author Enrico Zimuel (enrico@zimuel.it)
 */
class Login_Form_Login extends Zend_Form
{   
	private $_timeout;
        private $_returnUri;
	
	public function __construct($options=null) {
		if (is_array($options)) {
			if (!empty($options['custom'])) {
				if (!empty($options['custom']['timeout'])) {
					$this->_timeout= $options['custom']['timeout'];
				}
				unset($options['custom']);
			}
		}
                
                
                $controllerFront = Zend_Controller_Front::getInstance();
                $this->_returnUri = $controllerFront->getRequest()->getRequestUri();

                
		parent::__construct($options);
	}
	
    public function init ()
    {
//        $this->addElement('hash', 'token', array(
//             'timeout' => $this->_timeout
//        ));

        $this->addAttribs([
            'class' => 'zend-form'
        ]);
        $this->addElement('hidden', 'returnUrl', [
        'value' => $this->_returnUri
        ]);
                
        $this->addElement('text', 'username', [
            'label'      => 'Username',
            'required' => true,
            'class' => 'form-control',
            'validators' => ['Alnum'],
            'required' => [
                'required' => 'required'
            ]
        ]);

        $this->addElement('password', 'password', [
            'label'      => 'Password',
            'required'   => true,
            'class' => 'form-control',
            'validators' => ['Alnum'],
        ]);
        $this->addElement('submit','submit', [
            'label'      => 'Login',
            'class' => 'btn btn-primary btn-block',
        ]);
    }
}