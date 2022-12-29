<?php

// Registration / Login
class MissingRequiredException extends Exception {}

// Registration
class EmailTakenException extends Exception {}
class UsernameTakenException extends Exception {}
class NotAnEmailException extends Exception {}
class PasswordMatchException extends Exception {}

// Login
class UsernameNotFoundException extends Exception {}
class WrongPasswordException extends Exception {}
