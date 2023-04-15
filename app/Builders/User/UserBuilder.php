<?php

namespace App\Builders\User;

use App\Builders\BaseBuilder;
use App\Enums\UserTypeEnum;

class UserBuilder extends BaseBuilder
{
    /**
     * Where first name is.
     * @param string $firstName
     * @return self
     */
    public function whereFirstName(string $firstName): self
    {
        return $this->where('first_name', 'LIKE', "%{$firstName}%");
    }

    /**
     * Where email is.
     * @param string $email
     * @return self
     */
    public function whereEmail(string $email): self
    {
        return $this->where('email', 'LIKE', "%{$email}%");
    }

    /**
     * Where email is exact.
     * @param string $email
     * @return self
     */
    public function whereEmailExact(string $email): self
    {
        return $this->where('email', $email);
    }

    /**
     * Where phone number is.
     * @param string $phoneNumber
     * @return self
     */
    public function wherePhoneNumber(string $phoneNumber): self
    {
        return $this->where('phone_number', 'LIKE', "%{$phoneNumber}%");
    }

    /**
     * Where address is.
     * @param string $address
     * @return self
     */
    public function whereAddress(string $address): self
    {
        return $this->where('address', 'LIKE', "%{$address}%");
    }

    /**
     * Where created at is.
     * @param string $createdAt
     * @return self
     */
    public function whereCreatedAt(string $createdAt): self
    {
        return $this->whereDate('created_at', $createdAt);
    }

    /**
     * Where marketing is.
     * @param string $marketing
     * @return self
     */
    public function whereMarketing(string $marketing): self
    {
        return $this->where('is_marketing', $marketing);
    }

    /**
     * Where user type is.
     * @param UserTypeEnum $userType
     * @return self
     */
    public function whereUserType(UserTypeEnum $userType): self
    {
        return $this->where('is_admin', $userType);
    }
}
