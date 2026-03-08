# Notes until Exam 2

# Application Security Testing

## Vulnerability Assessment

Non-intrusive (no exploitation) way to detect sec risks

keep it contained to target - manage host list

**Authenticated** (with credentials) vs **Unauthenticated**(no creds) Scans

* auth scans can reveal more vuls

### Key Takeaways

* vul primarily comes form software
* continous scan with updated vul lists
* stay current and use best practices (like OWASP)
* Never trust user input
* Use frameworks and best practices fro lang and platform - don't roll your own encrpytion, don't DIY validation mechanism
* Do not exploit in production

### Challenges

container environments (services, versions, languages) change constantly and significantly

cloud services - can scan provider not service

keeping up to date with new vulnerabilites

create effective reports

### Vulnerability Assesment Reporting

## Penetration Testing

always have permissions for a pen test

"Only amateurs attack machines; profesisonals target people"

### Phase 0: What is the Scope?

What exactly is our goals and plans for the test.

What are we testing/attacking?

### Phase 1: Recon

Gathering info - what websites, services, systems, and software being used

* look at company website
* check job listings for tech used
* visits and use applications
* check out employees online (ex. linkedin)

### Phase 2: Discovery

find hosts, open ports, services, vulnerabilities

use tools like nmap

### Phase 3: Exploitation

try to exploit found vul - do with permission, don't do in production

* auth bypass, SQL injection

### Phase 4: Reporting

document EXACTLY the vulnerability found and how it is exploited

descirbe how to fix - code change, patch, SW update, etc.

### Types of Pen Test

#### Network

focus on vul within network.

#### Application

*class focus*

target specific application

##### Dynamic vs. Static

**Static:** perform source code analysis (SCA). detect vul in code

**Dynamic:** peform pen test on activiely running an application

#### Physical

testing physicaly security of a location

#### Social Engineering

targeting people/social relationships

* Phishing, leaving USB drives around, asking someone to do a task

### Pen Test Box Types

#### Black

* Pen Tester has very little knowledge of a system
* Doesn't know server software
* No credentials
* No source code access

#### White

* Pen tester has credentials and software versions
* might have source code access and perform source code analysis (SCA) on it
* Can confirm SCA with pen test

#### Grey

* between black and white boxes

### Teams

#### Red Team

offensive - attempting to break in networks/apps, find exploits, vulnerabilities

#### Blue Team

defensive - people who attempt to defend network and application

#### Competitions

* National Cyber League
* Cyber Defense Competition
* Lockdown

#### Real World

Organizations have both team types

## Software Dev Vulnerabilities

### Buffer Overflow

buffer is read or written from beyond designate bounds

Can trigger when data is bigger than allocated space for it

#### Heartbleed

TLS vul - heartbeat packets ("connection is still open" messages) could be manipulated to be smaller that they said. The server would then leak info in responses using that extramemory. 64kg is the size, so an attacker would hide that a packet is actually 1kg.

### Race Conditions

Software/code that depends on timing or resource access

Software can be exploited if the timing of resoruce access is not controlled, cause untintended execution of code.

Make sure code executes in the order it needs to.

### Input Validation Attacks

*class focus*

NEVER trust user input

NEVER use client side validation to establish trust

DO NOT create your own input validation mechanism

ex. XSS, SQL Injection, Path Injection

### Authentication Attacks

Attacking Authentication mechanism

* SQLi (queries without proper auth)
* password attacks - weak policies, pw stored in text/clear, pw reset exploits
* access obfuscated, but not protected, data

#### Defense

* enforce best crypto practices
* pw resets, account locks after several attmepts
* inform users when unrecognized devices logs in or attempts auth
* timeouts and challenges for failed attempts

### Authorization Attacks

attacker attempts to bypass authorization.

* access data that only specific users should - Role-based access control (RBAC)
* bypass auth check with direct URL or on client side

#### Defense

Auth check should be done each time it is required - based on role not user

### Cryptography Attacks

not very common, usually happens when custom crypto implementation is created by dev. These usually include some vul.

#### Defense

Follow best practices, don't DIY crypto

## Best Practices Exercises

OWASP - Crypto Storage Cheat Sheet

mt_rand() -insecure random gen, predictable

OWASP - TLS Cheat Sheet

disable compression. Vul can leak sensitive info to attack

Use TLS for all pages - event on "secure" internals. Attackers can sniff data or inject malicious code

## Evaluating Domain Security

Use tools like ssllabs.com/ssltest to get sec evaluation of site

Use established server configs:

https://ssl-config.mozilla.org/

https://wiki.mozilla.org/Security/Server_Side_TLSClient Side Attacks

## Client-Side Attacks

client is the target

### Cross Site Scripting (XSS)

Attacker inject malicous code into a site to attack another user of the site

### Cross Site Request Forgery(CSRF)

attack that forces user to do unwanted actions by the attack on a site where the victim has authentication

tricks victim into submitting maliciosu request

## Server-Side Attacks

attacking server, which inevitably affects clients

Injection attacks, accessing residual files, arbritrary code execution, privledge escaltion (attacker increase level of auth beyond intended for a user)

## Key Takeaways

3/3/26 + 3/5/26 - Notes

In Class Zap Quesitons

1. **Vulnerability assesment vs penetration tests:** Vulnerability assement - scan for existing vulnerabilities/sec within the system, Pen Test - simulate an attack
2. **Passive vs Active Scan** Passive Safe scan scans application and doesn't change responses and requests. Active will try real attacks and can damage system, tries to modify responses and attack
3. Passive scan is safe
4. Yes, ZAP (active scan) is a real attack
5. No, dont use on prod
6. Why explore an app manually - attacks don't have credentials

ZAP attack/use

Content Security Policy (CSP)

robots.txt - tell scrapers/bots where they can access (doesn't enforce, bots can go outside this)

localhost/server-status - we can

Alert section - has vulnerablities and sec issues in this section

Always can modify client-side requests/responses
configure firefox - use local hostport 8080 for manual proxy, turn on hijacking

Zap - history tab has request and response

## SQLi

"select userId from users where username = '$username' and password = '$password'"

input username as `admin' or 1=1 -- ` 

the first tick after admin closes the data string then adds 1=1 

-- comments out the rest of it 

`username = 'admin' or 1=1 ` is a tautology and always true