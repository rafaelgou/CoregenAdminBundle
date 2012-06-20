Coregen Admin
=============

Symfony2 Admin Bundle on top of CoregenAdminGenerator, FOSUserBundle and ThemeBootstrapBundle

Implements simple User and Log Models.

For while, just for ORM (ODM coming soon).

## Install

### deps

    [DoctrineExtensions]
        git=git://github.com/l3pp4rd/DoctrineExtensions.git
        target=gedmo-doctrine-extensions
        version=v2.1.0

    [DoctrineExtensionsBundle]
        git=git://github.com/stof/StofDoctrineExtensionsBundle.git
        target=bundles/Stof/DoctrineExtensionsBundle
        version=1.0.0

    [PSSDoctrineExtensionsBundle]
        git=git://github.com/rafaelgou/PSSDoctrineExtensionsBundle.git
        target=bundles/PSS/Bundle/DoctrineExtensionsBundle

    [FOSUserBundle]
        git=git://github.com/FriendsOfSymfony/FOSUserBundle.git
        target=bundles/FOS/UserBundle

    [ThemeBootstrapBundle]
        git=git://github.com/rafaelgou/ThemeBootstrapBundle.git
        target=bundles/Theme/BootstrapBundle

    [CoregenAdminGeneratorBundle]
        git=git://github.com/rafaelgou/CoregenAdminGeneratorBundle.git
        target=bundles/Coregen/AdminGeneratorBundle

    [CoregenThemeBootstrapBundle]
        git=git://github.com/rafaelgou/CoregenThemeBootstrapBundle.git
        target=bundles/Coregen/ThemeBootstrapBundle


(add to deps file and run `./bin/vendors install`)

### app/AppKernel.php

    //...
    public function registerBundles()
    {
        $bundles = array(
            //...
            new FOS\UserBundle\FOSUserBundle(),
            new Theme\BootstrapBundle\ThemeBootstrapBundle(),
            new Coregen\AdminGeneratorBundle\CoregenAdminGeneratorBundle(),
            new Coregen\ThemeBootstrapBundle\CoregenThemeBootstrapBundle(),
            new Coregen\AdminBundle\CoregenAdminBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new PSS\Bundle\DoctrineExtensionsBundle\PSSDoctrineExtensionsBundle(),
            new PHPGitolite\AdminBundle\PHPGitoliteAdminBundle(),
            //...
      );

      //...

### autoload

    //...
    $loader->registerNamespaces(array(
        //...
        'FOS'              => __DIR__.'/../vendor/bundles',
        'Coregen'          => __DIR__.'/../vendor/bundles',
        'Theme'            => __DIR__.'/../vendor/bundles',
        'Stof'             => __DIR__.'/../vendor/bundles',
        'Gedmo'            => __DIR__.'/../vendor/gedmo-doctrine-extensions/lib',
        'PSS'              => __DIR__.'/../vendor/bundles',
        //...
    ));
    //...

### Routing

On *app/config/routing.yml*

    ThemeBootstrapBundle:
        resource: "@ThemeBootstrapBundle/Resources/config/routing.yml"
        prefix:   /themebootstrap

### Security

On *app/config/security.yml*

    security:
        providers:
            fos_userbundle:
                id: fos_user.user_manager

        firewalls:
            main:
                pattern: ^/
                form_login:
                    provider: fos_userbundle
                logout:       true
                anonymous:    true
                security:     true

        access_control:
            - { path: ^/login$, role: IS_AUTHENTICATED_ANONYMOUSLY }
            - { path: ^/register, role: IS_AUTHENTICATED_ANONYMOUSLY }
            - { path: ^/resetting, role: IS_AUTHENTICATED_ANONYMOUSLY }
            - { path: ^/reader/, role: ROLE_USER }
            - { path: ^/admin/user/, role: ROLE_ADMIN }
            - { path: ^/admin/, role: ROLE_USER }
            - { path: ^/search/, role: ROLE_USER }
            - { path: ^/change-password/, role: ROLE_USER }

        role_hierarchy:
            ROLE_ADMIN:       ROLE_USER
            ROLE_SUPER_ADMIN: ROLE_ADMIN

        encoders:
            "FOS\UserBundle\Model\UserInterface":
                algorithm: sha512
                encode_as_base64: false
                iterations: 1

Or as you want.

### Security

On *app/config/config.yml*, add


    fos_user:
        db_driver: orm
        firewall_name: main
        user_class: Coregen\AdminBundle\Entity\User

    stof_doctrine_extensions:
        default_locale: en_US
        orm:
            default:
                tree: true

    pss_doctrine_extensions:
        blameable:
            user_class: Coregen\AdminBundle\Entity\User
            store_object: true
            drivers:
                orm: true
                mongodb: false

### Instaling Assets

    app/console assets:install web

or, if you want to symlink the assets

    app/console assets:install web --symlink

### Update database

After configure the database, run:

    app/console doctrine:schema:update --force

### Create a new User

Instead of using FOSUser's create command, use Corengen's. It permits to inform
the name of the user. All other FOSUser's commands can be used as usual.

    coregen
      coregen:user:create                   Create a user.
    fos
      fos:user:activate                     Activate a user
      fos:user:change-password              Change the password of a user.
      fos:user:create                       Create a user.
      fos:user:deactivate                   Deactivate a user
      fos:user:demote                       Demote a user by removing a role
      fos:user:promote                      Promotes a user by adding a role
