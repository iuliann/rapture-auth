# Rapture PHP Authentication component

[![PhpVersion](https://img.shields.io/badge/php-5.4-orange.svg?style=flat-square)](#)
[![License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](#)

Auth component uses interfaces to create the authentication logic:
- `UserInterface` - user model main methods like `getId`, `getName`, `isAuthenticated`, `isAnonymous`
- `SourceInterface` - user fetching method
- `StorageInterface` - user storing (usually a session adapter)

## Requirements

- PHP v5.4

## Install

```
composer require iuliann/rapture-auth
```

## Intro

```php
class User implements UserInterface, SourceInterface
{
    /*
     * SourceInterface
     */

	/**
     * @param array $data Authentication data
	 *
	 * @return $this
     */
    public function fetchUser($data)
    {
        $data += ['email' => null, 'password' => null];

        $user = UserQuery::create()->filterByEmail($data['email'])->findOne();

        if ($user && password_verify($data['password'], $user->getPassword())) {
            return $user;
        }
    
        return new self;
    }
    
    /*
     *  UserInterface
     */
    
    public function getId()
    {
    	return $this->id;
    }
    
    /**
     * getName
     *
     * @return string
     */
    public function getName()
    {
        return $this->getFirstname();
    }

    /**
     * Check if user is anonymous
     *
     * @return bool
     */
    public function isAnonymous()
    {
        return (int)$this->getId() == 0;
    }

    /**
     * Check if user is authenticated
     *
     * @return bool
     */
    public function isAuthenticated()
    {
        return !$this->isAnonymous();
    }
}
```

## About

### Author

Iulian N. `rapture@iuliann.ro`

### Testing

```
cd ./test && phpunit
```

### License

Rapture PHP Authentication is licensed under the MIT License - see the `LICENSE` file for details.
