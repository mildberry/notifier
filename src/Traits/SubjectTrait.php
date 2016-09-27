<?php

namespace Mildberry\Notifier\Traits;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
trait SubjectTrait
{
    /**
     * @var string
     */
    protected $subject;

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }
}
