# 1 - Intro to Compsec

## Security Ideals

- only see what we should be able to
- can't modify what we should not be able to
- can verfiy what we are seeing is from entity we expect
- can access things that should be available
- protected from bad actors, failures, negligence, misuse

## CIA Triad (Guiding Principles)

1. Confidentiality
   - only authorized user can view data
   - user authorization and authentication 
2. Inegrity
   - no unauthorized modificiations
   - ensure data is from source or sender
3. Availability
   - systems and services are available
   - resilient against attacks, failures, compromises
  

## DATA

**Data at Rest**

stored files, data in database, physical folders/storage

**Data in Motion**

communicated through web, sent via netowrk. radio data (WiFi, Blueooth, NFC, LoRa, etc.)


## Threats, Vulnerabilities, Risks

**Threats**

something that can cause harm to system/services 

**Vulnerabilities**

where there is opening for harm.

ex. insecure code, lack of backup, physicial security to data center

**Risks**

possbility of threat happening

### Managing Risks

1. Identify Assets - why do we need to protect?
2. Identify Threats - what can cause harm?
3. Assess Vulnerabilities - which would have high impact
4. Assess Risk - what is impact of the vulnerability? what can we accept?
5. Mitigate Risks - how do we reduct risks? 

### Incident Response

1. Preperation - how to respond?
2. Detection & Analysis - how we detect and understand it
3. Containment - ensure damage and effects are contianed and don't spread
4. Eradication - how to remove cause of incident
5. Recovery - how to get back to functionality


## Defense in Depth

Want multiple layers of defense like:
- External network - VPN, logging, pen tests
- Network Perimeter - firewalls, proxies, logging
- Internal Network - IDS, IPS, logging
- Host - Auth, hardening, antivirus, scanning
- Appplication - patching, auditing, pen test
- Data - enrcryption, backups, auth
