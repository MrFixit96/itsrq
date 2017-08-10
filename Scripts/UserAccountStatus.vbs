Set objUser = GetObject _
  ("LDAP://cn=myerken,ou=management,dc=fabrikam,dc=com")

If objUser.AccountDisabled = FALSE Then
      WScript.echo "The account is enabled."
Else
      WScript.echo "The account is disabled."

End If