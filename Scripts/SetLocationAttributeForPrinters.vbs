'Description
'Uses ADSI to configure the location attribute for all printers in a specified OU. 

Script Code 

Set objOU = GetObject("LDAP://OU = Finance, DC = fabrikam, DC = com")
objOU.Filter = Array("printqueue")
For Each objPrintQueue In objOU
objPrintQueue.Put "Location" , "USA/Redmond/Finance Building"
objPrintQueue.SetInfo
Next
