<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/31/17
 * Time: 11:30 PM
 */

namespace App\AppInterface;


use App\Entity\Payment;

interface PaymentInterface extends BaseInterface
{
    public function create(Payment $payment);
    public function update(Payment $payment, $id);

}