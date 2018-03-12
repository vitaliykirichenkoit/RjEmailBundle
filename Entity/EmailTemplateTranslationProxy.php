<?php

namespace Rj\EmailBundle\Entity;

use Gedmo\Translator\TranslationProxy;
use Rj\EmailBundle\Validator\TwigTemplate;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

class EmailTemplateTranslationProxy extends TranslationProxy
{
    /**
     * @NotBlank
     */
    public function getSubject()
    {
        return $this->getTranslatedValue('subject');
    }

    public function setSubject($subject)
    {
        $this->setTranslatedValue('subject', $subject);

        return $this;
    }

    /**
     * @NotBlank
     */
    public function getBody()
    {
        return $this->getTranslatedValue('body');
    }

    public function setBody($body)
    {
        $this->setTranslatedValue('body', $body);

        return $this;
    }

    public function setBodyHtml($body)
    {
        $this->setTranslatedValue('bodyHtml', $body);

        return $this;
    }

    /**
     * @NotBlank
     */
    public function getBodyHtml()
    {
        return $this->getTranslatedValue('bodyHtml');
    }

    public function setFromEmail($fromEmail)
    {
        return $this->setTranslatedValue('fromEmail', $fromEmail);
    }

    /**
     * @Email
     */
    public function getFromEmail()
    {
        return $this->getTranslatedValue('fromEmail');
    }

    public function setFromName($fromName)
    {
        return $this->setTranslatedValue('fromName', $fromName);
    }

    public function getFromName()
    {
        return $this->getTranslatedValue('fromName');
    }

    /**
     * @return mixed
     */
    public function getTestEmailTo()
    {
        return $this->getTranslatedValue('testEmailTo');
    }

    /**
     * @param string $emailTo
     *
     * @return EmailTemplateTranslationProxy
     */
    public function setTestEmailTo($emailTo)
    {
        $this->setTranslatedValue('testEmailTo', $emailTo);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTestVariables()
    {
        return $this->getTranslatedValue('testVariables');
    }

    /**
     * @param string $variables - JSON array
     *
     * @return EmailTemplateTranslationProxy
     */
    public function setTestVariables($variables)
    {
        $this->setTranslatedValue('testVariables', $variables);

        return $this;
    }

    /**
     * @return string
     */
    public function getMandrillSlug()
    {
        return $this->getTranslatedValue('mandrillSlug');
    }

    /**
     * @param string $mandrillSlug
     *
     * @return EmailTemplateTranslationProxy
     */
    public function setMandrillSlug($mandrillSlug)
    {
        $this->setTranslatedValue('mandrillSlug', $mandrillSlug);

        return $this;
    }

    /**
     * @return string
     */
    public function getPreheader()
    {
        return $this->getTranslatedValue('preheader');
    }

    /**
     * @param string $preheader
     *
     * @return EmailTemplateTranslationProxy
     */
    public function setPreheader($preheader)
    {
        $this->setTranslatedValue('preheader', $preheader);

        return $this;
    }
}
