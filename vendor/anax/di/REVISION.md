Revision history
=================================


v1.0.9 (2017-10-15)
---------------------------------

* Add DIServiceSetBaseTrait and DIFactoryTest to ease unit testing of modules using di.


v1.0.8 (2017-09-26)
---------------------------------

* Minor rewrite of DIFactoryConfig::configure().


v1.0.7 (2017-09-26)
---------------------------------

* DIFactoryConfig now uses Config2Trait that allows to read configuration items from both files and from a directory containing files.


v1.0.6 (2017-09-25)
---------------------------------

* Add config/di_anax-site-develop.php as a more complete setup of services to work with anax development.


v1.0.5 (2017-09-14)
---------------------------------

* Make setDI return self.


v1.0.4 (2017-09-11)
---------------------------------

* Made DI instance variables protected instead of public.
* Remove commented section with magic methods from DI.
* Adding DIFactoryConfigMagic that uses DIMagicTrait.
* Adding testcases for DIFactoryConfigMagic.


v1.0.3 (2017-08-17)
---------------------------------

* Require specific DIInterface.
* Allow to activate service directly by configuration file setting.


v1.0.2 (2017-08-10)
---------------------------------

* Major rework doing integration test.


v1.0.1 (2017-08-09)
---------------------------------

* Rewrote DIFactoryDefault.
* Added DIFactoryConfig which reads services from configuration file.
* Adding sample klass App/AppDI which is InjectionAware.


v1.0.0 (2017-06-29)
---------------------------------

* Made it close to supporting PHP-FIG 11 Container, using DI instead of Container.
* First inofficial release, moved from Anax MVC.
