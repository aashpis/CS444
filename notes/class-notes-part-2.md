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

When you find a vul, you need to report it

assess risk and include ways to fix

Check NVD - National Vulnerability Database for vulnerability

Check CWE - Common Weakness Enumeration -> NVD is particular examples of CWE in software

## Penetration Testing

always have permissions for a pen test

"Only amateurs attack machines; profesisonals target people"

Scope -> Recon -> Discovery -> Exploit -> Report

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

1=1 gets us first row

# 3/17/2026

make index.php file

var/www/html/

<html>
<body>
<?php

    function createGreeting($name){
        return "Hello $name";
    }

    $who = "344" . " Class";$greeting = creatGreeting($who);

    $who = "344" . " Class";
    echo "`<h1>`Hello $who!`</h1>`";

    $regArray = array("A", "B", "A");
    $aArray = array("name" => "Brian", "id" => 20);

    foreach($regArray as $grade){
        echo "You got a $grade `<br />`";
    }

    foreach($aArray as $key=>$val){
        echo "$key = $val `<br />`";
    }
    print_r($regArray);
?>

</body>
</html>

---

login.php

<?php
    $username = $_POST["username"];
    $password = $_POST["password"];


    // password is assignement not comparison
    if ($username == "abc123" && $password = "secure") {  // $password == secure
        echo "Welcome Ari"
    }
?>

<form action="login.php" method="post">
Username: <input type="text" name="username"/>
Password: <input type="password" name="password"/>
<button type="submit"></button>
</form>

---

For test, you will examine code for vulnerabilities

you can inject html code in a post

---

# 3/19/2026

## Gen AI

can generate vul code.

It is an assistant, your name is on your code you are responsible for it

can also analyze code

# OWASP Top 10 (Web, also mobile, IoT)

## A01 - Broken Access Control

Person is able to access data, pages, accounts that they shouldn't have time

### Prevention

- auth check on every request
- permit/allowlists, deny all else
- log failures

### In Class Code Example:

hidden input field to check for admin. Admin check is client side

`<input type="hidden" name="isAdmin" value="<?=$user->isAdmin?>">`

`->` in php is like a `.` (access a func/value)

## A02 - Security Misconfiguration

- default accounts/pw not changed
- disclosing stack traces
- not hardening apps or os
- uneeded services are running

### Prevention

- Log but don't disclose any info to attack/client
- disable services that aren't needed
- apply least priviledge
- disable default error reporting
- PHP - turn off error handling

### In Class Exercise

- Don't display errors to clients as it reveals info about system and can lead to exploits
- Limit size or turn off file upload -> attackers can upload malicious files, zip bombs, DoS by continous upload
- Turn off ability to execute external programs

## A03 - Software Supply Chain Failure

- attack supply chain, libraries that bring in software
- code that brings in dependencies can be vul
- secure code can use vulnerable libraries
- monitor CVE and NVD (National Vulnerability Database)

### SWBOM - Software Bill of Materials

Tracks libraries used in SW

### Supply Chain and CI/CD

code AND supply chain should be analyzed on pushes to repo

openSSF has tool to check supply chain

## A04 - Crpytographic Failures

- using weak algos (MD5)
- not using salt
- insecure num gen
- storing secrets in the clear

### Prevention

1. use most updated practices
2. don't roll own encryption

### In Class code Excercise

not md5, use PHP's password_hash()

## A05 - Injection

Broad category, includes SQLi, XSS, LDAP Injection

user input not validated or sanitzed

### Prevention

- use frameworks/APIs for queries
- always validate and sanitize, don't directly use user input

### SQLi - SQL Injection

- use parameterized queries/bind parameters
- **don't concat strings directly into queries**

### In-class code

PHP - use `prepare` and `bind_param` to create queries

`$sql = "INSERT INTO users (name, email, age, address, phone) VALUES ('$name', '$email', $age, '$address', '$phone')";`

Don't give error data to client

```PHP
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error; // HERE is vul
}
```

### XSS - Cross Side Scripting

user supplied data contains JavaScript that executes in browser

2 Forms: Stored(persisted) vs Reflective

#### Prevention

- CSP - Content Security Policy. allowlsit for content
- Make sure no JS or HTML gets sent to user from database
- Encode data on way out from persisted db, not on way in

#### In-class code

<h2> and <p> name and email could be injected with JS

```PHP
if ($result->num_rows > 0) {
// Fetch and display each user's data
    while ($user = $result->fetch_assoc()) {
        echo '<div>';
        echo '<h2>' . $user['name'] . '</h2>';
        echo '<p>Email: ' . $user['email'] . '</p>';
        echo '</div>';
    }
} else {
    echo 'No users found.';
}
```

Can inject via name, email. sql statement directly used with values no sanitation

```PHP
$sql = "SELECT id, name, email FROM users";
$result = $mysqli->query($sql)
```

## A06 - Insecure Design

very broad category - how code is designed and implementation, not the code itself

- disclosing system info
- no auth at endpoints
- not applying least priviledge or defense in depth
- no input validation

### In-class code

`echo "Error: " ` don't give full error message to user, shows `$stmt` and `phpinfo()`

## Other Vul

### A07 - Auth Failures

- weak passwords
- default configs with default passwords
- Session id in url
- sessions not validated

### A08 - SW and Data Integrity Failure

Using software without validating signature, libraries from untrusted repositories

### A09 - Security Logging & Alerting Failures

log events, but don't log sensitive info (user password)

### A10 - Mishandling of Exceptional Conditions

Handle errors, don't reveal stack traces or error data to client

## Gen AI

### Example 1

- has string concat
- giving user full error message
- storing username and pw in code
- not logging errors

### Example 2

- user name, pw stored in plain tet
- connection error being revealed to user

## Key Takeaways

never trust user input

use frameworks and lang best practices (ex. ORM)

- shouldnt be writing raw SQL

Stay up to date on new threats and vuls

Monitor CVE and NVD

continous review OWASP

# Authorization and Authentication - 3/24/26

## Identity

Any entity that is unique

Distinguishing element

### Identity in Computer System

Any entity that can be verified

- DNS, WIFI, User, servers

### How do we verify?

Passwords, certificates, tokesn, biometrics, examine proof

### Falsify Identification

Buy data on darkweb, spoofing, stealing creds

## Authentication

process to determinie wther identity is the identity the claim to be

### Auth Factors

Most common ways to auth:

#### something you know

- password
- challenge questions
- PIN

##### Weaknesss

Passwords - Need to store , they can be leaked, can be forgotten, weak passwords

PINs - weak, easy to crack

Challenge Questions - answers can be easily guessed or can be found out

#### Something you are

biometrics

face, hand, retina scans

Fingerprints

##### Weaknesss

exspensive, need hardware, privacy concerns, implementation can be weak

#### Something you have - physical key, hardware token

- Phone
- SW based token
- USB token
- ATM Card
- Badge

##### Weaknesss

cost to implement, can clone data, lost/stolen device replacement

#### Other ways

- something you do (gesture, gait)

  - perform gesture
  - gait
  - physical signature/hand writing
- Where you are (GPS location, source IP)

### Authentication Mechanisms

#### Simple/Single-Factor Auth

not strong enough

- choose one factor auth user
- commonly "something you know"
- usually a password

#### Multi-Factor Authetication (MFA) - also 2-Factor Auth

Combine 2 of 3

- something you know
- something you are
- something you have

#### Out of Bandd Auth

Not specific to MFA/2FA

Perform auth using diff channel

- receive phone call or text with token

##### Problems

If you are authing from phone, it's not out-of-band to receive text since you're on the same device

- PCI standard says no

### Mutual Authentication

Entity authentication client AND client auths entity

- accessing web app, certain WiFi networks

Digital Certs. commonly used for this

SSH - need to verify host/server then host verifies key

#### If you don't auth server

- MITM attack
- connect to malicious server

### Password

longer is better than random characters

adding 1 bit can double time to guess

#### Good Password Policy

- just go for length
- don't force password changes
- don't force random characters, upper/lower case, numbers, etc.
- use password manager

### Biometrics

- Universality - everyone would have in your system
- Uniqueness - target of measurement unique for individuals
- Permanence - is element permanent, does it change with age?
- Collectability - how easy to aquire/measure?
- Performance - how quick doees it verify?
- Acceptability - will user allow it?
- Circumvention - can it be bypassed?

#### Balancing Performance

##### FAR - False Acceptance Rate

Accepting user biometric data when you shouldn't have

##### FRR - False Rejection Rate

Denying user biometric data when you shouldn't have

##### ERR - Equal Error Rate

Balance between two, can accept minor flaws in biometric scanning, but not so much where someone else can auth

### Hardware Tokens

Token generated by based on identifier and a clock

Auth with one factor, use token for the other

Ex. Microsoft Authenticator, Google Authenticator, Duo Security

### Passkeys

Emerging Area of auth (as of 3/24/26)

based on FIDO - Fast IDentity Online - Standard

Eliminates password and username.

Uses Public-key crypto

- private key stays on device
- public key on server
- Passkey is unique to username and website
- Uses secure hardware like TPM (Trusted Platform Module) or Enclave (stores passwords, keys, verify integrity)

### Auth Systems

#### Database

store user info into separate DB table

Auth against DB

#### LDAP - Lightweight Directory Access Protocol

optimized for reads instead of read/write.

fast auth

#### AD - Active Directory

Microsoft: On-Premise or Azure

#### 3rd Party

Microsoft/Google/Apple, OpenID

#### Single-Sign On

Auth in one system, have access to all systems that trust it.

##### Key Terms

Identity Provider: provides ID and auth users

Service Provider: one that provides service, not auth

Principle: Identity/Subject who is trying to access service

#### OAuth

related to SSO.

Authorization mechanism. allows you to access other services with account as long as you authorize it.

Only authorization, doesn't authenticate

---

## Auth Exercise

PCI DSS

"SMS or voice has been deprecated and may be removed from future releases of their
publication"

SW Token is "something you have" if its embedded into physical device
---------------------------------------------------------------------

## Authorization

Determines if entity can do some action

Access Controls are set by attributes:

- User
- Role
- Group
- other

### Access Control Implementation

ACLs - Access Control Lists

- determines access of entity
- can use to allow/deny access to part or whole system

File System

- read/write/execute permissions

Network ACLs

- SSH allows only certain keys
- allowlist for IP for incoming/outgoing access

#### Issues with ACLs

Can require frequent updates depending on design

- like when system provisioned or user created

New permission model require new schemas

- new role -> new column

Denylist can get lengthy - use allowlists

Limiting users from sharing content that shouldn't be

#### Access Control Models

##### Role-based - RBAC

- determine access on roles user in
- users can exist in multiple roles
- easier to track and manage than by user

##### Rule-Based

use set of rules - like IP range

##### Relationship-Based - ReBAC

Ownership of data (e.g. update, delete a post)

Others

##### Attribute-Based

attributes or properties does the entity contain

##### Discrectionary-Based

resource owner determines who has access and what type

##### Mandatory

seperate group determines who has access

Gov orgs use may this

### Best Practices

1. Never assign permissions based on role
2. Use RBAC (roles-based) for permissions in app
3. Use ReBAC (relationships-based) for relationships to data
4. Use existing frameworks

### Recap

Authentication vs Authorization: who you are vs what you can do

identity provider - has credentials vs. service provider - how to sign in/auth

Something you have - a phone

False - 2FA has to be two diff categories not just methods

False - Set auth based on role

mutual auth - accessing a webpage (both client and server auth each other, digital cert)

- prevent MITM or spoof attack

# Privacy (3/27/26)

unless there is a business case/need, don't store data.

- don't be liable for breaking privacy laws

Tons of data being tracked and aggregated by all devices. Very little protection and enforcement

## Regulation

- GDPR - General Data protection Regulation
- CCPA - California Consumer Privacy Act

other laws not protective enough

data collect -> profile built -> sold to data brokers

## Web Privacy

HTTP is stateless. servers uses cookies with info to remember

- cookies not necessarily bad, can have session info on it

### Private Browsing

Each browser contains "fingerprint"

- IP
- browser type
- cookies
- extensions
- other props unique to your browser

### DNS

DNS can also leak privacy.

DNS server receives all requests you send.

- going through ISP DNS means that ISP knows all requests

[https://dnsleaktest.com/](https://dnsleaktest.com/)

### VPNs

adds some hops along way to destination

- hides IP, but not identity

needs to trust VPN service

### What Can You Do?

- limit use of sites with clickbait
- don't use Google for search
- use more private browser
- install ad blocker
- other extensions:
  - ghostery, privacy badger
  - careful of malicious extensions

## Mobile Privacy

Once data is out there, no way to get rid of it.

Apps request access to location - after giving permission:

- how often is it read?
- who else has access?
- where does it go? where is it stored?

Photos has lots of info

- location/time/date
- phone model
- what camera was used

Contacts info

### Data Misuse

Services use invasive cookies and trackers and collect data unrelated to the service provided.

- Linkedin
- Weather.com
- NOAA

### EMPAware Project

shows users real-time use/collection of their raw data and where it is sent:

- show precise location
- fingerprints of device
- monitoring clicks
- which domains it was sent, including ad/tracking services

could grab info from contacts list

- name, birthday, contact information

### Trackers in Mobile Apps

top 124 apps in iOS

- most have 2-8 trackers
- some had ~22 unique trackers
- most by google, amazon, meta

### Tracker Categories

1. Action Pixels: collect user specific events
2. Ad Fraud: to prevent ad fraud
3. Motivated tracking: ads that include beacons, demographic collection
4. Advertising
5. Analytics
6. Audience Measurement : like analytics but with more demographic and behaviors
7. Social Network
8. Third Party Analytics

### Mobile Carriers

Carrier can track you as well

### Why Can You Do?

- delete social media apps + accounts
- Dark Patterns - add friction to use
- review app permissions
- review data access/sharing
- disable Ad ID tracking
- be wary of location sharing
- limit sharing of personal data (photos)
- switch search engines to private ones
- use apps where data isn't their revenue

## Social Media

your data = revenue

doesn't protect your data

more emotional/distressing content is more engaging

### Dark Patterns / Bad Design

feed is like slot machine. swipe down = pull down

Notifications, urgency, emails to go on platform

easy to post. comments and likes for dopamine hits

Easy to create profile, harder to delete

## Data Monetization

Data is auctioned off, sold, traded.

Advertisers "bid" on your ad space - based on demographics, motivations, (male, fitness:depression)

- happens in milliseconds, winner displays add

## Surveillance

mobile, web, dns can track you

tracking pixels

### Surveillance Pricing

using personal data for dynamic pricing

- charge you based on data collected (ex. higher income -> higher prices)

### AI as surveillance

your data can be used in AI models

- influence your opinion
- better track you
- figure out personal info/demographics
- 

## What Can You Do

Use non-ISP DNS

Disconnect TV from internet

Blur home from Maps (google, apple, bing)

## Resources:

coveryourtracks.eff.org

- tests browser privacy

nothingprivate.gkr.pw
---------------------

ipleak.net

- shows IP and guess of location

dnsleaktest.com
---------------

pi-hole.net

# Implementing Autho + Authen in Spring - In Class Demo - 3/31/26

REST - representational state transfer

- standardized systems using HTTP protocol (GET POST PUT etc)
- 

Gradle

- manages dependencies, need to re-sync everytime dependencies change

Dependency Injection

- give function/object directly

Don't put sensotive info in URL, pass data in reqeust body

# Implementing Autho + Authen in Spring - In Class Demo - 4/2/26

Sidenote Privacy resource: EFF atlas of surveillance

Spring Sec - sec by default

- need to auth, all endpoints shut by default
- CSRF is defaut in spring sec - need to disable to use postman

Postman - can use basic auth

- insecure over HTTP
- but is secure over HTTPS, creates auth header with creds

# Compliance and Laws - 4/7/26

# Compliance

various laws and standards need to followed in comp sec.

Usually an org handles this

## Regulatory Compliance

deals with specific industries and laws relative to it

train employees, get certs

## Industry Compliance

Not laws, but industry standards

PCI DSS

## PCI-DSS - Payment Card Industry Data Security Standard

might be on exam

Rules created Visa, Mastercard, American Express

defines sec req for an org

### In-class exercise

**1.2.5** - All services, protocols, and ports allowed are
identified, approved, and have a defined business
need

- use nmap to identify all ports

**4.2.1** - Strong cryptography and security protocols are implemented as follows to safeguard PAN during transmission over open, public networks:

- can use internal self-signed cert.
- external CA - need to communicate with external servers

**6.2.3** - Bespoke and custom software is reviewed prior to being released into production or to customers, to identify and correct potential coding vulnerabilities, as follows:

- Code reviews ensure code is developed according to secure coding guidelines.
- Code reviews look for both existing and emerging software vulnerabilities.
- Appropriate corrections are implemented prior to release

## Compliance Failure

can get fined or lose business if not in compliance

Trust is hard to regain when failures happen

PCI-DDS non-compliance can block ability to process cards

## Info Sec Policy

Orgs need well defined policies that are easy to find

Each policy should address a diff area of compliance

- have date of creation, updated, by whom

## Controls

Used to stay in compliance

3 Categories

- Technical: firewalls, OS hardening, ACIs, IDS, etc.
- Administrative: process/procedures like change control systems, ticketing systems
- Physical: Badges to access a space/boundry, cameras, security guards and checkpoint

## Control Types

Key Controls (Primary Controls)

- Vital control - stands alone to mitigate risks
- Failure means risk not mitigate and compliance failure

Compensating Controls

- controls when you are not in compliance
- can bebridge to compliance
- Ex. segregating network - maybe not immediately feasible, but can be implemented in future

## Maintaining Compliance

**Monitor -> Review -> Document -> Report**

**Monitor**

- Continously monitor and review controls you have
- Log activity, aggredate control data

**Review**

- controls still effective?
- what new risk change effectivenes of control
- what new attacks are you not monitoring

**Document**

- document findings from review - good to show auditors you're actively working on your controls
- what changes have been made historically

**Report**

- share findings to leadership, demonstrate value

# Laws

Diff laws in diff countries - need to stay compliant with ever changing laws

Newly passed laws will impact org policies

## In-class NIST Exercise

not on exam

## FISMA - Federal Information Security Management Act

- Compliance for businesses that administer federal programs (includes orgs that receive grants)
- Sec controls must implemented using risk-based approach
- Data must be protected
- Org must pass an audit to be authorized to operate

## FedRAMP - Federal Risk and Authorization Management Program

- focus cloud providers
- Gov orgs must follow specific rules for cloud providers
- cloud providers must get authorization

## HIPAA - Health Insurance Portability and Accountability Act

- For health data
- PHI - Protected Health Info has specific reqs for storage and safeguarding
- includes req for protecting data integrity and availability

## Financial Acts

SOX - Sarbanes-Oxely Act

- Regulation specific to financial reporting and assets
- response to Enron

GLBA - Gramm-Leach-Bliley Act

- protect PII - personal identifiable info
- focus on financial orgs
- must protect info and notifiy customers when info is shared

## CIPA - Childrens Internet Protection Act

- prevent kids from accessing harmful or obscene internet content
- low-cost internet access is provided to eligible institutions to help them with compliance

## COPPA - Children's Online Privacy Protection Act

- can't collect PII or use trackers for kids younger than 13
- Privacy Policy must be shared
- Parent consent for younger

What official IDs do kids have? How do you stay compliant?

## FERPA - Family Education Rights and Privacy Acts

Parents do not have access to student records unless student gives permissions

## GDPR - General Data Protection Regulation (EU only)

- consent before collecting data
- right to be forgotten: ask orgs to delete personal data
- right to data portability: you can download your personal data in some common format
- cookie prompts

Need to be aware of local laws for compliance

gdpr.eu

### Exercise

Max Fine - 20 million euros or 4% of revenue

## Frameworks

Key Idea: start with what exists, don't start from scratch

provides model for achieving compliances

### Provider of Frameworks

ISO - internal organization for standardization

NIST - National Institute of Standards and Technology

# Compliance in Emerging Areas

Cloud Computing

- who is responsible
- Iaas -> SaaS (infrastructer or service provider responsible?)

IoT

- more scrutiny on devices that have default PWs
- Set standards for IoT: how data is collected, maintained, shared
