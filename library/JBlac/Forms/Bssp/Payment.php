<?php

class JBlac_Forms_Bssp_Payment extends JBlac_Form
{
    
    public static $validateUnique = true;

    public function init()
    {    
        $paymentId = new Zend_Form_Element_Hidden('id');
        $paymentId->removeDecorator('Label');
        $applicationId = new Zend_Form_Element_Hidden('applicationId');
        $applicationId->removeDecorator('Label');
        $fundsId = new Zend_Form_Element_Hidden('fundsId');
        $fundsId->removeDecorator('Label');
        
        $paymentAmount = new Zend_Form_Element_Text('amount');
        $paymentAmount->setLabel('Payment Amount(in Namibian dollars)')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'placeholder ' => 'Enter payment amount',
                    'maxlength' => '12'                    
                ))
                ->setRequired()
                ->addFilter('StripTags')
                ->addFilter('stringTrim')
                ->addFilter('Digits');

        $paymentPhase = new Zend_Form_Element_Select('phase');
        $paymentPhase->setLabel('Payment Phase');
        $lov = [
                        '' => 'Select phase',
                        'first'      => 'First Instalment',
                        'second'     => 'First Instalment',
                        'third'      => 'Third Instalment',
                        'fouth'      => 'Fouth Instalment',
                        'fifth'      => 'Fifth Instalment',
                        'sixth'      => 'Sixth Instalment',
                        'seventh'    => 'Seventh Instalment',
                        'eigth'      => 'Eigth Instalment',
                        'nineth'     => 'Nineth Instalment',
                        'tenth'      => 'Tenth Instalment',
                ];

        $paymentPhase->setMultiOptions($lov)
                ->setAttribs(array(
                    'class' => 'form-control selectric',
                    'required' => true,
                ));
        
        $dateOfPayment = new Zend_Form_Element_Text('dateOfPayment');
        $dateOfPayment->setLabel('Date Of Payment')
                ->setAttribs(array(
                    'class' => 'form-control datepicker',
                    'placeholder ' => 'Enter date of payment',
                    'maxlength' => '12'                    
                ))
                ->setRequired();
        
        $remarks = new Zend_Form_Element_Textarea('remarks');
        $remarks->setLabel('Payment Remarks')
                ->setAttribs(array(
                    'class' => 'form-control',
                    'rows' => 3,
                    'placeholder ' => 'Enter payment remarks',                  
                ))
                ->setRequired(FALSE);

           $this->addElements(array(
                    $paymentId,
                    $fundsId,
                    $applicationId,
                    $paymentAmount,
                    $paymentPhase,
                    $dateOfPayment,               
                    $remarks,
                ));                               
    }
}