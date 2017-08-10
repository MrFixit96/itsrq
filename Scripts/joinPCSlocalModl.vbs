'users will need to logon to their computer with adminlocal and password gohome
'this script will rename the docs and settings folder %username% to docsetbak.its
'(this will later be copied into their new docs and settings folder)
'then the script will join the computer to the new pcs.local domain

'copy docs and settings folder



'Join computer to pcs.local
Const JOIN_DOMAIN             = 1
Const ACCT_CREATE             = 2
Const ACCT_DELETE             = 4
Const WIN9X_UPGRADE           = 16
Const DOMAIN_JOIN_IF_JOINED   = 32
Const JOIN_UNSECURE           = 64
Const MACHINE_PASSWORD_PASSED = 128
Const DEFERRED_SPN_SET        = 256
Const INSTALL_INVOCATION      = 262144

strDomain   = "pcs"
strPassword = "neaddsixtwo"
strUser     = "administrator"

Set objNetwork = CreateObject("WScript.Network")
strComputer = objNetwork.ComputerName

Set objComputer = GetObject("winmgmts:{impersonationLevel=Impersonate}!\\" & _
                   strComputer & "\root\cimv2:Win32_ComputerSystem.Name='" & _
                   strComputer & "'")

ReturnValue = objComputer.JoinDomainOrWorkGroup(strDomain, _
                                                strPassword, _
                                                strDomain & "\" & strUser, _
                                                NULL, _
                                                JOIN_DOMAIN + ACCT_CREATE)
msgbox(ReturnValue)