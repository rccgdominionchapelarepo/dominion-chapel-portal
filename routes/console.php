<?php

use Illuminate\Support\Facades\Artisan;
use Mailtrap\Helper\ResponseHelper;
use Mailtrap\MailtrapClient;
use Mailtrap\Mime\MailtrapEmail;
use Symfony\Component\Mime\Address;

Artisan::command('send-mail', function () {
    // We pull the 'From' details directly from your .env settings
    $fromAddress = env('MAIL_FROM_ADDRESS', 'hello@demomailtrap.co');
    $fromName = env('MAIL_FROM_NAME', 'Dominion Chapel');

    $email = (new MailtrapEmail())
        ->from(new Address($fromAddress, $fromName))
        ->to(new Address('tobilobaolutomi@gmail.com')) // RECIPIENT PLACEHOLDER
        ->subject('You are awesome!')
        ->category('Integration Test')
        ->text('Congrats for sending test email with Mailtrap!');

    // Initialize using the securely stored API token
    $response = MailtrapClient::initSendingEmails(
        apiKey: config('services.mailtrap.secret')
    )->send($email);

    $this->info('Mail sent! Response:');
    var_dump(ResponseHelper::toArray($response));
})->purpose('Send Mail via Mailtrap API');