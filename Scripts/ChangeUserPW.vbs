Set objUser = GetObject _
    ("LDAP://cn=myerken,ou=management,dc=fabrikam,dc=com")
objUser.ChangePassword "i5A2sj*!", "jl3R86df"
