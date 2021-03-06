<?php

use Laasti\Mailer\Message;
use Laasti\Mailer\Servers\FileServer;
use Laasti\Mailer\Servers\NullServer;
use Laasti\Mailer\Servers\SMTP;
use Monolog\Logger;

class MailerTest extends  \PHPUnit_Framework_TestCase {

    protected $smtp;
    protected $message;

    public function setup(){
        $this->smtp = new SMTP(new Logger('Mailer'), 'relais.videotron.ca', null, null, 25, null);
        $this->fileserver = new FileServer(__DIR__.'/maillogs', new Logger('FileServer'));
        $this->message = new Message();
    }

    public function testSMTP(){

        $this->message
            ->setFrom('Sonia', 'soniamarquette@gmail.com') // your name, your email
            ->setFakeFrom('Whoot', 'bot@hello.com') // a fake name, a fake email
            ->addTo('Sonia', 'soniamarquette@gmail.com')
            ->setSubject('Test SMTP ' . time())
            ->setBody('<h1>for testÉ</h1>')
                ->addAttachment('license.txt', __DIR__.'/../LICENSE.txt')
                ->addAttachment('readme.txt', __DIR__.'/../README.md');

        $status = $this->smtp->send($this->message);
        $this->assertTrue($status);
    }
/*
    public function testMail(){
        $mail = new Mail(new Logger('Mail'));
        $this->message
            ->setFrom('Sonia', 'soniamarquette@gmail.com') // your name, your email
            ->setFakeFrom('Whoot', 'soniamarquette@gmail.com') // a fake name, a fake email
            ->addTo('Sonia', 'soniamarquette@gmail.com')
            ->setSubject('Test Mail ' . time())
            ->setBody('<h1>for test</h1>');

        $status = $mail->send($this->message);
        $this->assertTrue($status);
    }
    public function testSendmail(){
        $mail = new Sendmail(new Logger('Sendmail'));
        $this->message
            ->setFrom('Sonia', 'soniamarquette@gmail.com') // your name, your email
            ->setFakeFrom('Whoot', 'soniamarquette@gmail.com') // a fake name, a fake email
            ->addTo('Sonia', 'soniamarquette@gmail.com')
            ->setSubject('Test Sendmail ' . time())
            ->setBody('<h1>for test</h1>');

        $status = $mail->send($this->message);
        $this->assertTrue($status);
    }
 */
    public function testNullServer(){
        $mail = new NullServer(new Logger('NullServer'));
        $this->message
            ->setFrom('Sonia', 'soniamarquette@gmail.com') // your name, your email
            ->setFakeFrom('Whoot', 'soniamarquette@gmail.com') // a fake name, a fake email
            ->addTo('Sonia', 'soniamarquette@gmail.com')
            ->setSubject('Test NullServer ' . time())
            ->setBody('<h1>for test</h1>');

        $status = $mail->send($this->message);
        $this->assertTrue($status);
    }
    public function testFileServer(){
        $mail = new FileServer(__DIR__.'/maillogs', new Logger('FileServer'));
        $this->message
            ->setFrom('Sonia ÉÉÉ', 'soniamarquette@gmail.com') // your name, your email
            ->setFakeFrom('Whoot ÉÉÉ', 'soniamarquette@gmail.com') // a fake name, a fake email
            ->addTo('Sonia', 'soniamarquette@gmail.com')
            ->setSubject('Test FileServerÉÉÉ ' . time())
            ->setTextBody('Text testsé')
            ->setBody('<h1>for testé</h1>')
                ->addAttachment('license.txt', __DIR__.'/../LICENSE.txt')
                ->addAttachment('readme.txt', __DIR__.'/../README.md');

        $status = $mail->send($this->message);
        $this->assertTrue($status);
    }
/*
    public function testSend(){
        $status = (new Mailer(new SMTP(new Logger('Mailer'), 'relais.videotron.ca',null, null, 25, null)))
            ->setFrom('Sonia', 'bot@ym.txthinking.com') // your name, your email
            ->setFakeFrom('É全蛋', 'zhangquandan@hello.com') // a fake name, a fake email
            ->addTo('Sonia', 'soniamarquette@gmail.com')
            ->setSubject('hello é'. time())
            ->setBody('Hi, boy é')
            ->send();
        $this->assertTrue($status);
    }
*/
}

