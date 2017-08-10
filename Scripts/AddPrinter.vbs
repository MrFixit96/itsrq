Set WshNetwork = CreateObject("WScript.Network")
WshNetwork.AddWindowsPrinterConnection "\\pcs-svr01\hs209-bw2"
WshNetwork.SetDefaultPrinter "\\pcs-svr01\hs209-bw2"