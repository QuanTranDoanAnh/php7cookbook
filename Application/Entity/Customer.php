<?php
namespace Application\Entity;

class Customer extends Base
{
    const TABLE_NAME = 'customer';
    protected $name = '';
    protected $balance = 0.0;
    protected $email = '';
    protected $password = '';
    protected $status = '';
    protected $securityQuestion = '';
    protected $confirmCode = '';
    protected $profileId = 0;
    protected $level = '';
    
    protected $mapping = [
        'id' => 'id',
        'name' => 'name',
        'balance' => 'balance',
        'email' => 'email',
        'password' => 'password',
        'status' => 'status',
        'security_question' => 'securityQuestion',
        'confirm_code' => 'confirmCode',
        'profile_id' => 'profileId',
        'level' => 'level'
    ];
    
    /**
     * @return string $name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }
    /**
     * @return float $balance
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @return string $email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string $password
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string $status
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string $securityQuestion
     */
    public function getSecurityQuestion(): string
    {
        return $this->securityQuestion;
    }

    /**
     * @return string $confirmCode
     */
    public function getConfirmCode(): string
    {
        return $this->confirmCode;
    }

    /**
     * @return int $profileId
     */
    public function getProfileId(): int
    {
        return $this->profileId;
    }

    /**
     * @return string $level
     */
    public function getLevel(): string
    {
        return $this->level;
    }

    /**
     * @param float $balance
     */
    public function setBalance($balance)
    {
        $this->balance = (float) $balance;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param string $securityQuestion
     */
    public function setSecurityQuestion($securityQuestion)
    {
        $this->securityQuestion = $securityQuestion;
    }

    /**
     * @param string $confirmCode
     */
    public function setConfirmCode($confirmCode)
    {
        $this->confirmCode = $confirmCode;
    }

    /**
     * @param number $profileId
     */
    public function setProfileId($profileId)
    {
        $this->profileId = (int) $profileId;
    }

    /**
     * @param string $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }


    
    
}

