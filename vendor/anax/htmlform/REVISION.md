Revision history
=================================


v1.0.3 (2017-09-19)
---------------------------------

* Always have default class=htmlform on <form>.
* Add test for styling forms.
* Move use_fieldset to create(), can be overridden in getHTML().
* Move legend to create(), can be overridden in getHTML().
* Make Form properties protected, not public.
* Enable to set class attribute to the output element through Form::setOUtputClass().
* Create FormElementInputButton and move createHTML there.
* Make FormElement abstract and create a FormElementFactory.
* Add option to add JavaScript in onclick for buttons.
* Make <br> after label configurable on create and on specific element.


v1.0.2 (2017-08-24)
---------------------------------

* Removing Form constructor, must call create explicit.
* Integrating with Anax DI, depending on anax/di.
* Depending on anax/session.
* Depending on anax/request.
* Depending on anax/response.
* Depending on anax/url.
* Rewriting FormModel, use Form instead of extend.
* Update all example programs for FormModel.
* New setup of class FormModel, use Form, not extend.
* New example programs for validate.


v1.0.1 (2017-08-17)
---------------------------------

* Last tag before integrating Anax DI.
* Remove reference to Lydia in FormElement.


v1.0.0 (2017-08-15)
---------------------------------

* First setup, copied from mos/cform and rewritten to the anax namespace.
