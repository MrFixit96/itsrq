echo off
rem MadRiver Subnet Mask 255.255.255.248 other IPs below
rem We have IP addrs 216.166.249.114-118 inclusive
cls
echo pinging inside of PCS CA router
ping 192.168.1.254
echo .
echo If the above pings did not get replies,
echo the problem is internal.  Call IT Services
echo .
pause
cls
echo pinging outside of PCS CA router
ping 216.166.249.114
echo .
echo If the above pings did not get replies,
echo the problem is internal.  Call IT Services
echo .
pause
cls
echo pinging ISP's gateway
ping 216.166.249.113
echo .
echo If the above ping did not get replies, the problem
echo is external.  Call the ISP and inform them that we
echo do not have Internet service.  If they doubt you,
echo say, "I can ping the external IP address of our router
echo but I cannot ping your gateway."
echo Madison River Customer Service 1-877-249-1841.
echo .
pause
cls
echo pinging ISP's primary DNS server
ping 208.241.20.25
echo pinging ISP's secondary DNS server
ping 208.241.20.26
echo .
echo If the above pings did not get replies, the ISP's DNS
echo servers are down.  Call the ISP and tell them.
pause
cls
echo .
echo Also please notify IT Services and log all failures
echo with the time you noticed it was down and the time it 
echo came back up.  Thank you.
pause