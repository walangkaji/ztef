# ZTE F Series API

Library ini merupakan **Emboh**. TITIK
- **ZTE F609** ✅ (Tested)
- **ZTE F670** ✅ (Tested)

## Requirements
Works with PHP 8.0 or above

## Installation
```sh
composer require walangkaji/ztef
```

## Example
```php
<?php

require __DIR__ . '/vendor/autoload.php';

use ZteF\Exception\LoginException;
use ZteF\ZteF;

try {
    $zte = new ZteF('192.168.1.1', 'admin', 'Telkomdso123', true);

    // Get status
    $status = $zte->status()->deviceInformation();
    var_dump($status);

    // Reboot device
    // $reboot = $zte->administration()->systemManagement()->reboot();
    // var_dump($reboot);

} catch (LoginException $e) {
    echo $e->getMessage() . \PHP_EOL;
} catch (\Exception $e) {
    echo $e->getMessage() . \PHP_EOL;
}

// Terusno dewe

```
## Help
### Status
| Name | Method | |
| --- | --- | --- |
| Device Information | `$zte->status()->deviceInformation();` | ✅ |
| Network Interface | `$zte->status()->networkInterface();` |  |
| -- WAN Connection | `$zte->status()->networkInterface()->wanConnection();` | ✅ |
| -- 3G/4G WAN Connection | `$zte->status()->networkInterface()->wanConnection3Gor4G();` | ❌ |
| -- 4in6 Tunnel Connection | `$zte->status()->networkInterface()->tunnelConnection4in6();` | ❌ |
| -- 6in4 Tunnel Connection | `$zte->status()->networkInterface()->tunnelConnection6in4();` | ❌ |
| -- PON information | `$zte->status()->networkInterface()->ponInformation();` | ✅ |
| -- Mobile Network | `$zte->status()->networkInterface()->mobileNetwork();` | ✅ |
| User Inteface | `$zte->status()->userInterface();` |  |
| -- WLAN Radio2.4G | `$zte->status()->userInterface()->wlan24G();` | ❌ |
| -- WLAN Radio5G | `$zte->status()->userInterface()->wlan5G();` | ❌ |
| -- Ethernet | `$zte->status()->userInterface()->ethernet();` | ❌ |
| -- USB | `$zte->status()->userInterface()->usb();` | ❌ |
| VoIP Status | `$zte->status()->voIpStatus();` | ✅ |

### Network
| Name | Method | |
| --- | --- | --- |
| WAN | `$zte->network()->wan();` |  |
| -- WAN Connection | `$zte->network()->wan()->wanConnection();` | ❌ |
| -- 3G/4G WAN Connection | `$zte->network()->wan()->wan3G4GConnection();` | ❌ |
| -- 4in6 Tunnel Connection | `$zte->network()->wan()->tunnelConnection4in6();` | ❌ |
| -- 6in4 Tunnel Connection | `$zte->network()->wan()->tunnelConnection6in4();` | ❌ |
| -- Port Binding | `$zte->network()->wan()->portBinding();` | ❌ |
| -- DHCP Release First | `$zte->network()->wan()->dhcpReleaseFirst();` | ✅ |
| WLAN Common Setting | `$zte->network()->wlanCommonSetting();` |  |
| -- WiFi Restrictions | `$zte->network()->wlanCommonSetting()->wifiRestrictions();` | ❌ |
| WLAN Radio2.4G | `$zte->network()->wlan();` |  |
| -- Basic | `$zte->network()->wlan()->basic();` | ❌ |
| -- SSID Settings | `$zte->network()->wlan()->ssidSetting();` | ❌ |
| -- Security | `$zte->network()->wlan()->security();` | ❌ |
| -- Access Control List | `$zte->network()->wlan()->accessControlList();` | ❌ |
| -- Associated Devices | `$zte->network()->wlan()->associatedDevices();` | ❌ |
| -- WDS | `$zte->network()->wlan()->wds();` | ❌ |
| -- WMM | `$zte->network()->wlan()->wmm();` | ❌ |
| -- WPS | `$zte->network()->wlan()->wps();` | ❌ |
| WLAN Radio5G | `$zte->network()->wlan5G();` |  |
| -- Basic | `$zte->network()->wlan5G()->basic();` | ❌ |
| -- SSID Settings | `$zte->network()->wlan5G()->ssidSetting();` | ❌ |
| -- Security | `$zte->network()->wlan5G()->security();` | ❌ |
| -- Access Control List | `$zte->network()->wlan5G()->accessControlList();` | ❌ |
| -- Associated Devices | `$zte->network()->wlan5G()->associatedDevices();` | ❌ |
| -- WDS | `$zte->network()->wlan5G()->wds();` | ❌ |
| -- WMM | `$zte->network()->wlan5G()->wmm();` | ❌ |
| -- WPS | `$zte->network()->wlan5G()->wps();` | ❌ |
| LAN | `$zte->network()->lan();` |  |
| -- LAN-LAN Isolation | `$zte->network()->lan()->lanIsolation();` | ✅ |
| -- DHCP Server | `$zte->network()->lan()->dhcpServer();` | ❌ |
| -- DHCP Server(IPv6) | `$zte->network()->lan()->dhcpServerIpv6();` | ❌ |
| -- DHCP Binding | `$zte->network()->lan()->dhcpBinding();` | ❌ |
| -- DHCP Port Service | `$zte->network()->lan()->dhcpPortService();` | ❌ |
| -- Prefix Management | `$zte->network()->lan()->prefixManagement();` | ❌ |
| -- DHCP Port Service(IPv6) | `$zte->network()->lan()->dhcpPortServiceIpv6();` | ❌ |
| -- RA Service | `$zte->network()->lan()->raService();` | ❌ |
| PON | `$zte->network()->pon();` |  |
| -- LOID | `$zte->network()->pon()->loid();` | ❌ |
| -- SN | `$zte->network()->pon()->sn();` | ❌ |
| Routing(IPv4) | `$zte->network()->routingIpv4();` |  |
| -- Default Gateway | `$zte->network()->routingIpv4()->defaultGateway();` | ❌ |
| -- Static Routing | `$zte->network()->routingIpv4()->staticRouting();` | ❌ |
| -- Policy Routing | `$zte->network()->routingIpv4()->policyRouting();` | ❌ |
| -- Routing Table | `$zte->network()->routingIpv4()->routingTable();` | ❌ |
| Routing(IPv6) | `$zte->network()->routingIpv6();` |  |
| -- Default Gateway | `$zte->network()->routingIpv6()->defaultGateway();` | ❌ |
| -- Static Routing | `$zte->network()->routingIpv6()->staticRouting();` | ❌ |
| -- Policy Routing | `$zte->network()->routingIpv6()->policyRouting();` | ❌ |
| -- Routing Table | `$zte->network()->routingIpv6()->routingTable();` | ❌ |
| Port Locating | `$zte->network()->portLocating();` | ❌ |

### Security
| Name | Method | |
| --- | --- | --- |
| Firewall | `$zte->security()->firewall();` | ❌ |
| IP Filter | `$zte->security()->ipFilter();` | ❌ |
| MAC Filter | `$zte->security()->macFilter();` | ❌ |
| URL Filter | `$zte->security()->urlFilter();` | ❌ |
| ALG | `$zte->security()->alg();` | ✅ |

### Application
| Name | Method | |
| --- | --- | --- |
| VoIP | `$zte->application()->voIP();` |  |
| -- WAN Connection | `$zte->application()->voIP()->wanConnection();` | ❌ |
| -- Advanced | `$zte->application()->voIP()->advanced();` | ❌ |
| -- Fax | `$zte->application()->voIP()->fax();` | ✅ |
| -- SIP | `$zte->application()->voIP()->sip();` | ❌ |
| -- SIP Accounts | `$zte->application()->voIP()->sipAccounts();` | ❌ |
| -- VoIP Services | `$zte->application()->voIP()->voIpServices();` | ❌ |
| -- Digital Map | `$zte->application()->voIP()->digitalMap();` | ❌ |
| -- Media | `$zte->application()->voIP()->media();` | ❌ |
| -- Caller ID | `$zte->application()->voIP()->callerId();` | ❌ |
| -- SLIC configuration | `$zte->application()->voIP()->slicConfiguration();` | ❌ |
| DDNS | `$zte->application()->ddns();` | ❌ |
| DMZ Host | `$zte->application()->dmzHost();` | ❌ |
| UPnP | `$zte->application()->upnp();` | ❌ |
| UPnP Port Mapping | `$zte->application()->upnpPortMapping();` | ❌ |
| Port Forwarding | `$zte->application()->portForwarding();` | ❌ |
| DNS Service | `$zte->application()->dnsService();` |  |
| -- Domain Name | `$zte->application()->dnsService()->domainName();` | ❌ |
| -- Hosts | `$zte->application()->dnsService()->hosts();` | ❌ |
| -- DNS | `$zte->application()->dnsService()->dns();` | ❌ |
| SNTP | `$zte->application()->sntp();` | ❌ |
| MultiCast | `$zte->application()->multiCast();` |  |
| -- IGMP WAN Connection | `$zte->application()->multiCast()->igmpWanConnection();` | ❌ |
| -- MultiCast Mode | `$zte->application()->multiCast()->multiCastMode();` | ❌ |
| -- MLD WAN Connection | `$zte->application()->multiCast()->mldWanConnection();` | ❌ |
| -- Basic Configuration | `$zte->application()->multiCast()->basicConfiguration();` | ❌ |
| -- VLAN Configuration | `$zte->application()->multiCast()->vlanConfiguration();` | ❌ |
| -- Maximum Address Configuration | `$zte->application()->multiCast()->maximumAddressConfiguration();` | ❌ |
| BPDU | `$zte->application()->bpdu();` | ✅ |
| USB Storage | `$zte->application()->usbStorage();` | ❌ |
| DMS | `$zte->application()->dms();` | ❌ |
| FTP Application | `$zte->application()->ftpApplication();` | ❌ |
| Port Trigger | `$zte->application()->portTrigger();` | ❌ |
| Port Forwarding ( Application List ) | `$zte->application()->portForwardingAppList();` | ❌ |
| Application List | `$zte->application()->applicationList();` | ❌ |
| Samba Service | `$zte->application()->sambaService();` | ❌ |
| USB print server | `$zte->application()->usbPrintServer();` | ✅ |

### Administration
| Name | Method | |
| --- | --- | --- |
| TR-069 | `$zte->administration()->tr069();` |  |
| -- Basic | `$zte->administration()->tr069()->basic();` | ❌ |
| -- Certificate | `$zte->administration()->tr069()->certificate();` | ❌ |
| User Management | `$zte->administration()->userManagement();` |  |
| -- WEB User Management | `$zte->administration()->userManagement()->webUserManagement();` | ❌ |
| Login Timeout | `$zte->administration()->loginTimeout();` | ✅ |
| System Management | `$zte->administration()->systemManagement();` |  |
| -- Reboot | `$zte->administration()->systemManagement()->reboot();` | ✅ |
| -- Software Upgrade | `$zte->administration()->systemManagement()->softwareUpgrade();` | ❌ |
| -- User Configuration Management | `$zte->administration()->systemManagement()->userConfigurationManagement();` | ❌ |
| -- Default Configuration Management | `$zte->administration()->systemManagement()->defaultConfigurationManagement();` | ❌ |
| -- USB Backup | `$zte->administration()->systemManagement()->usbBackup();` | ❌ |
| -- USB Restore | `$zte->administration()->systemManagement()->usbRestore();` | ❌ |
| Log Management | `$zte->administration()->logManagement();` | ❌ |
| Diagnosis | `$zte->administration()->diagnosis();` |  |
| -- Ping Diagnosis | `$zte->administration()->diagnosis()->pingDiagnosis();` | ❌ |
| -- Trace Route Diagnosis | `$zte->administration()->diagnosis()->traceRouteDiagnosis();` | ❌ |
| -- Simulation | `$zte->administration()->diagnosis()->simulation();` | ❌ |
| -- Mirror Configuration | `$zte->administration()->diagnosis()->mirrorConfiguration();` | ❌ |
| -- Voice Diagnosis | `$zte->administration()->diagnosis()->voiceDiagnosis();` | ❌ |
| -- ARP Table | `$zte->administration()->diagnosis()->arpTable();` | ✅ |
| -- MAC Table | `$zte->administration()->diagnosis()->macTable();` | ✅ |
| Loopback Detection | `$zte->administration()->loopbackDetection();` |  |
| -- Basic Configuration | `$zte->administration()->loopbackDetection()->basicConfiguration();` | ❌ |
| -- Enable Configuration | `$zte->administration()->loopbackDetection()->enableConfiguration();` | ❌ |
| -- VLAN Configuration | `$zte->administration()->loopbackDetection()->vlanConfiguration();` | ❌ |
| IPv6 Switch | `$zte->administration()->ipv6Switch();` | ❌ |
| VoIP Protocol Switch | `$zte->administration()->voIpProtocolSwitch();` | ❌ |
| 3G/4G Basic Configuration | `$zte->administration()->basicConfiguration3g4g();` | ✅ |

### Helpers
| Name | Method | |
| --- | --- | --- |
| Reboot | `$zte->helpers()->reboot();` | ✅ |
| Change IP | `$zte->helpers()->changeIp();` | ✅ |

## Todo
Masih buuuwanyak fitur yang belum di masukkan, nanti sambil nangis dikerjakan.

Pada dasarnya ini dibuat karena kebutuhan, nek ra butuh yo ra dibuat.
Monggo dibantu kak.

Matursuwun.

![Paypal](https://raw.githubusercontent.com/walangkaji/emboh/master/img/paypal.png) [Kopi-Kopi](https://www.paypal.me/walangkaji)
