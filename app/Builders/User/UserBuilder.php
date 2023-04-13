<?php

namespace App\Builders\User;

use App\Enums\UserTypeEnum;
use Illuminate\Database\Eloquent\Builder;

class UserBuilder extends Builder
{
    private const PER_PAGE = 10;
    
    /**
     * WHere UUID is.
     * @param string $uuid
     * @return self
     */
    public function whereUuid(string $uuid): self
    {
        return $this->where('uuid', $uuid);
    }

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
     * Sort by
     * @param string $column
     * @param bool $desc = false
     * @return self
     */
    public function sortBy(string $column, bool $desc = false): self
    {
        return $this->orderBy($column, $desc ? 'DESC' : 'ASC');
    }

    /**
     * Limit
     * @param int $limit
     * @return self
     */
    public function limit(int $limit): self
    {
        return $this->take($limit);
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
     * Where page is.
     * @param int $page
     * @return self
     */
    public function wherePage(int $page): self
    {
        return $this->skip(($page - 1) * self::PER_PAGE);
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