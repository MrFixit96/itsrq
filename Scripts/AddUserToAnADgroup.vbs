Const ADS_PROPERTY_APPEND = 3

Set objGroup = GetObject _
    ("LDAP://cn=graphicswsslocaladmins,ou=pcsusergroups,dc=peoriachristian,dc=org")
objGroup.PutEx ADS_PROPERTY_APPEND, _
    "member", Array("cn=james reg. anderton,ou=pcsadmins,ou=pcsusers,dc=peoriachristian,dc=org")
objGroup.SetInfo
