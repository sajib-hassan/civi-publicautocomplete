publicautocomplete
==================

This civicrm extension allows an anonymous user to have an autocomplete field instead of a free form one for the current employer, to avoid mispelled/duplicate organisation names

tested on profile edit (/civicrm/profile/create) and event registration (/civicrm/event/register), patch welcome for the rest

Install
======

git clone https://github.com/sajib-hassan/civi-publicautocomplete.git in your local extension repository and it should work

Or download from here https://github.com/sajib-hassan/civi-publicautocomplete/archive/master.zip


Configuration
=============

By default, it returns all the organisations. 
Think long and hard about what you really want to expose, if you value privacy, that's probably not what you want.

Is it normal for instance to provide the name of organisations that are your IT providers, banks, cleaning company, center for drug abuse, restaurants... 
Search all your organisations, and be sure you and they are ok being on a list associated with your org, I'll wait.

Including all the errors of people that registered online? Including the spams, fake or obscene organisation names? You know, when "Dick" from the company "two girls and a cup" registered to your events and newsletter?

So you do want to customise the list and restrict to a subset only? Good, that's what I thought.


Test & Access right
===================

To test, connect as a user having access to civicrm, create an event with a profile that contains a current employer field.

If everything is properly installed, you should have an autocomplete instead of a free form. 

You can now grant "access AJAX API" to anonymous users (or the users that needs to have the autocomplete) and voila.

Support and Evolutions
=====================
Ask in the extensions forum on civicrm.org.