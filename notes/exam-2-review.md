Exam #2 Topics

    Format will be a mix of TF, multiple choice, fill in the blank, short answer.

# Application Security and Testing

**Understand how to use Zed Attack Proxy and Burp Suite to perform penetration testing:**

Burp Suite: Intercept packets and manipulate them to exploit vulnerabilities

Zap Attack Proxy: scans web app and will attack any exploits found

**What is the purpose of an automated scanner, how is that different from manual pen testing?**

Automated scanners will go through the code and look for know vulnerabilities and exploits

Manual Pen Testing is when a person uses tools to find exploits in various ways with tools, including exploits outside of the source code.


**What is a vulnerability assessment?**

When you scan an application code to find potential exploits and vulnerabilities.
Then making a report about the risk factor and ways to prevent, mitigate it or if risk will be accepted

*     Why do we only focus on discovery and not exploitation? We can break an app.
*     Should we continually scan for vulnerabilities? Yes
*     Which reveals more, authenticated or unauthenticated scans? Authenticated
*     What challenge does cloud provide? Need to scan app not cloud provider. 

**What is the National Vulnerability Database? How can we use this in our reports?**

A database the contains known and publicized vulnerabilities.
Describes what the vulnerability is and it's severity and possible solutions and fixes.

For known vulnerabilities, we can reference the database to help find vulnerabilties, asses the risk and find fixes. 


# Pen Testing Process

**Understand the phases in penetration testing: Scoping → Recon → Discovery → Exploitation → Reporting**
1. Scope: what exactly are we attacking?
2. Recon: Gathering info: getting info on tech stacks, architecture, services, software, employees
3. Discovery: finding ports, hosts, services to attack. (use nmap to scan a network)
4. Exploitation: Trying to sucessful exploit a vulnerability
5. Reporting: Creating a report of exact exploits and vulnerabilities found - How it was found, what was done to exploit it, risk severity, ways to fix it.

**What are the different types of pen testing?**
*     Application: Attack an application
*     Network: Attack the network of systems
*     Physical: testing physical security of a place
*     Social engineering: targeting people and users
    
**What is the difference between static and dynamic pen testing?**

Static: scan source code for vulnerabilitites, perform source code analysis (SCA)

Dynamic: attack live, actively running application/service 

**Understand Black Box, White Box, and Grey Box testing and the differences.  Red Team vs Blue Team**

- Black Box: have 0 info and no credentials,
- White Box: have login credentials, knowledge of system (software versions), maybe source code access
- Grey box: have some knowledge and some credentials


# Software Vulnerabilities

**Understand what they are and how to prevent them:**

**Buffer overflow:**
- buffer is read from beyond designated bounds.
- can trigger when you try to store data that is larger than is designated size/bounds.
- Can release data beyond buffer
- Heartbleed vul

**Race conditions**
- when there is code or software that relies on specific timing or resource access 
- You can manipiulate the completion to change the order of execution or execute malicious/unauth code or commands
- need to make sure software can be only executed in specific order

**Input validation**
- when you can inject code in user input fields when it is not validated correctly.
- make sure to escape characters
- santize input, check for expected input, make sure it is within expected value range.
- Don't roll your own input validation, use established framework or library
- never trust user input
- never use client side validation 

**Authentication/authorization attacks (Weak password policies, cleartext storage of passwords and secrets, weak cryptography Bypassing authorization checks**)
- when you attack authentication mechanisms
- can have easily cracked passwords
- passwords and secrets can be leaked
- bad use or outdate cryptography can be trivial cracked
- can use manipulated queries for unauth database access.

Attacker can bypass auth checks
- using direct URL
- manipulate client-side checks

Prevention:
- always auth before executing a request that requires authorization
- use most updated cryptography practices
- Enable password resets after too many attempts
- Have timeouts and challenges on failed attempts
- Lock user accounts after too many failed logins
- Notifiy user(like emails) when new device logins into their account


**Understand difference between client side vs server side attacks**
- client-side: attacking clients/user of a service/system
- server-side: attacking the server/backend   

**XSS - Client**
- attacker injects code into system that attacks another user of that system
- like injecting javascript that activates when another access a page

**SQL Injection, Path Injection - Server**
- use user input to manipulate SQL queries.
- use user input to manipulate the path of a command to access other parts of system

**Review exploits in Juice Shop exercise and assignment**
- admin login: input as username: ` admin or 1=1 –- `
- leave review as someone else: use burpsuit to intercept packet, then manipulate data within it
- create account where password is `t`: create account with validated password, intercept the packet and change password
- accessing sensitive documents: look at url
- create admin user: intercept the packet for new user creation and change the role.

**PHP of review**
- string concatination of SQL query
- XSS: htmlspecialchars for input of posting a new camp
- path traversal:  GET request use user-inputed variable to GET something from the server

**Review questions from podcast in assignment**
Content Security Policies can be one of the best ways to stop XSS attacks


**Can we trust code that is generated from AI?** NO

# OWASP Top 10

Focus on top 6 of the top 10, know what they are, how to prevent them, and how to spot them

1. Broken Access Control: 
- Not implementing access control, permitting users that should not be permitted. users can access things they shouldn't

**Prevention:**
- Auth check on every requests
- use allowlist, deny everything else
- log failures - can find malicious or unintended activity 


2. Security Misconfiguration
- Example: Framework configuration, OS configuration, showing more information than necessary. 
- default accounts and PWs not changed
- not hardening apps and os (no firewalls, not configuring allowlist for ssh)
- unneeded services running
- using client-side auth checks 

**Prevention:**
- don't show stack traces or system erros, return a generic failed message.
- use Logs, but don't disclose errors to attackers.
- don't keep sensitive info in logs
- don't roll your security systems, use frameworks, built in functions
- scan for services and see which ones you actually need
- use least priviledge
- PHP turn off error handling
- limit file upload size and type 
- turn off ability to execute external programs

3. Software Supply Chain Failure
- Example: Using a library that has a vulnerability, not verifying the libraries/dependencies you are including
- Not updating dependencies when theres a vulnerability
- Not using reliable package manager
- secure code is not secure if the libraries called are vulnerable

**Prevention:**
- have a SOBM with versions or track libraries being used
- make sure libraries are correct and not malicious ones with similar names
- keep up with vulnerability reports
- always analyze supply chain along with code on pushes 
- don't allow devs to import their dependencies themselves

4. Cryptographic Failures
- Example: Using older hash algorithm, insecure encryption
- No salt with passwords
- storing secrets in the clear

**Prevention:**
- use updated cryptographic practices
- don't roll your own encryption
- use secure pseudo-random number generators
- use salt
- store cipher text

5. Injection
- Example: SQL injection, path injection, XSS
- user input not santized or validated
- use string concat for queries 
- revealing errors to users which leaks info on system  or queries being used, like table names
- escape characters 

**SQL/Path Injection Preventions:**
- use frameworks/API for queries
- always validate and sanitize input. 
- use parameterize queries, never concatination 

**XXS Preventions:**
- use CSP - Content Security Policy. allowlist for what content is allowed 
- ensure html/css/js is never sent from database
- encode data on way out from database, not on way in.  

6. Insecure Design
Example: Failure to authenticate an endpoint, failure to perform input validation, not applying principle of least privilege

Focus on input validation and examples in PHP that we reviewed
Be able to identify vulnerabilities in code and propose fixes
Understand potential damage of each vulnerability

**Prevention:**

- don't leak stack traces or system erros
- parameterized queires

## Other Top 10

7. Auth Failures
- weak PWs
- default configs and accounts not changed
- session id in url
- unvalidated sessions

8. SW and Data integrity failure
- using unverified/unvalidated (cert or signature not) SW and libraries 

9. Security Log and Aler failures
- make sure to log events without sensitive info

10. Mishandling of Exceptional Conditions
- handle errors without revealing error data to client

# Identity and Access Management

**Understand different ways of authenticating**
- something you know: password, challenge questions, PIN
- something you are: biometrics
- something you have: phone, SW token, USB based token, ATM card, a badge

Other ways:
- perform gesture
- gait
- physical signature/writing
- location

**What is multi-factor authentication? What are the different factors?**

Using at least two of the factors (something you have, are, or know) together for authentication. 

**What is mutual authentication and why is it important?**

When the client and server/entity both authenticate each other.

It verifies that both parties are who they say they are. 

Makes sure client connects to correct/non-malicious entity.

Entity can verify client is who they say they are. Prevents MITM attack.

**What is the difference between authentication and authorization?**

Authentication is who you are. Authorization is what actions you are able to execute and what you can access

**What is out of band authentication?**

Performing authentication using a different channel, like phone call or text with code

**Understand basics of setting a password policy on Linux**
    What options are available that we implemented in class

`pam_pwquality`

```bash
password requisite pam_pwquality.so retry=3 dcredit=-1 ucredit=-1 lcredit=-1 minlen=15 maxrepeat=1
```
- 3 tries to make a compliant password
- negative value means you need 1 digit
- negative value means you need 1 uppercase letter
- negative value means you need 1 lowercase letter
- min length of 15 chars
- no repeated characters in a row

**What are the different access control models (e.g. RBAC) and how did we apply access control to the operating system?**

RBAC - Role based 
- access is based on roles assigned to users
- users can have multiple roles
- best for permissions in an app
- make sure to use least priviledge

ReBAC - Relationship-Based
- Ownership of data (post, update, delete)
- best for relationship to data

**Other Types:**

Rule-Based
- based a set of rules, like IP range

Attibute-Based
- based on some attrivure entity has

Discrectionary-Based
- resource owner determines access

Mandatory
- seperate group determines access


# Privacy

**Understand different approaches to protecting privacy**
- use HTTPS
- VPNs
- use a diff DNS from ISP
- don't go to clickbaity sites
- don't use google 
- switch to more private browsers
- use ad blockers and other extensions:
    - ghostery, privacy badger
- uninstall apps you don't use
- limit app permissions and access (location, photos, other personal data)
- be cautious of apps you download
- don't use social media
- disable Ad Id tracking

**Understand different ways you can be tracked with mobile apps, web apps, search, pixels in emails, DNS, etc**
- mobile apps

**What is a browser fingerprint, is private browsing effective?**
- no, private browsing just deletes client side cookies, history, etc.
- 
fingerprints contains:
- IP address
- browser type
- extensions used
- can contain other properties to track and ID you

**Why is mobile privacy important?**

phones contain most of our personal data or access to it. 

always carrying it around. tracks your location

once data is out there, no way to delete it or know who has access.

# Laws and Compliance

Fundamentally understand why its important to carefully read the laws and to be compliant
    What are the consequences of not being compliant?
What is an information security policy? What should it contain?
    Date, who created it, what does it apply to
Understand the basic controls:
    Technical - What we did in class with OS hardening
    Administrative - Processes that you follow, documenting
    Physical - Locking rooms, barriers, security guards
Basic understanding of some of the laws, regulations, and industry standards, know what area it addresses:
        HIPAA
        PCI-DSS
        FERPA
        External: GDPR
            What does the right to be forgotten mean?

# Overall

Don't trust user input
Never create your own encryption
Stay current on best practices
Utilize existing frameworks / libraries
Do not exploit in production
Get permission before scanning
Follow laws, stay current, use frameworks and guidelines that exist

**Java Spring - What protections does it offer, what does it do for "free", why should we use it (or any  framework)?**
- Secure by default, all auth has been specified when using spring sec
- CSRF is default 
- Dependency Management
- Dependency Injection enables loose coupling