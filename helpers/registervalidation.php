<?php
function validateEmptyString($request, $name, &$errors)
{
  if (!isset($request[$name]) || empty($request[$name])) {
    $errors[$name] = 'Please enter a valid ' . $name;
  }
}
function validateEmail($request, $name, &$errors)
{
  if (!isset($request[$name]) || empty($request[$name]) || !filter_var($request[$name], FILTER_VALIDATE_EMAIL)) {
    $errors[$name] = 'Please enter a valid ' . $name;
  }
}
function validateRequest($request)
{
  $errors = [];
  validateEmptyString($request, 'name', $errors);
  validateEmptyString($request, 'username', $errors);
  validateEmptyString($request, 'password', $errors);
  validateEmptyString($request, 'confirm_password', $errors);
  if (
    isset($request['password']) && isset($request['confirm_password'])
    && $request['password'] != $request['confirm_password']
  ) {
    $errors['password_confirm'] = 'Password confirmation does not match';
  }
  validateEmail($request, 'email', $errors);
  return ['data' => $request, 'errors' => $errors];
}