Const ADS_UF_ACCOUNTDISABLE = 2

Set objUser = GetObject _
  ("LDAP://cn=myerken,ou=management,dc=fabrikam,dc=com")
intUAC = objUser.Get("userAccountControl")

If intUAC AND ADS_UF_ACCOUNTDISABLE Then
  objUser.Put "userAccountControl", intUAC XOR ADS_UF_ACCOUNTDISABLE
  objUser.SetInfo
End If