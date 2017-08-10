Set objComputer = GetObject _
    ("LDAP://CN=atl-dc-01,CN=Computers,DC=fabrikam,DC=com")
objComputer.Put "location", "Building 37, Floor 2, Room 2133"
objComputer.SetInfo