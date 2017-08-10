Set objUser = GetObject _
("LDAP://cn=myerken,ou=management,dc=fabrikam,dc=com")

objUser.GetInfoEx Array("profilePath"), 0
strCurrentProfilePath = objUser.Get("profilePath")

intStringLen = Len(strCurrentProfilePath)
intStringRemains = intStringLen - 11
strRemains = Mid(strCurrentProfilePath, 12, intStringRemains)
strNewProfilePath = "\\fabrikam" & strRemains

objUser.Put "profilePath", strNewProfilePath
objUser.SetInfo