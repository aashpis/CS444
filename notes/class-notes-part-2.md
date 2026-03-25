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
        echo "You got a $grade`<br />`";
    }

    foreach($aArray as $key=>$val){
        echo "$key = $val`<br />`";
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
    echo "Error: " . $stmt->error; // HERE
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

### A09 - Security 

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

Auth in one system, have access to all systems that trsut it. 

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
--- 


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

### ReCAp

Authentication vs Authorization: who you are vs what you can do 

identity provider - has credentials vs. service provider - how to sign in/auth

Something you have - a phone

False - 2FA has to be two diff categories not just methods

False - Set auth based on role

mutual auth - accessing a webpage (both client and server auth each other, digital cert)
- prevent MITM or spoof attack