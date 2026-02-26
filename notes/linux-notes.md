cm

# Knowing Location

`pwd` - lists current working directory

`ls [PATH]` - list files in current dir

- `ls -l` - list files and permissiosn
- `ls -a` - see hidden files

# Directory/Paths

`cd` - change directory

`.` - current dir

`..` - one dir up

`~` - home dir of user

`/` - root dir

`*` - Wildcard, can be mixed in pathnames or filenames

- ex: `rm *.c` removes all files that end with `.c`

# Users and Groups

`sudo adduser <username>`

`sudo groupadd <groupname>`

`sudo usermod -a -G <group> <username>`

# File Access and Read

`cat <FILE>` - show contents of file

`grep <search term> [filename]` - Used to search contents within file or from output

`less <filename>` - Used to scroll through file

`head` - look at top of a file

`tail` - look at bottom of file

`tail -f <file>` - monitor any new input

If you want to monitor any new input on a file, you will want to do a tail-f on the file: `tail -f logfile`

`locate <name>` - locate this file

# File Permissions

3 Permissions - Read, Write, Execute

Represented by 3 bits: rwx

- 4 (r) = read
- 2 (w) = write
- 1 (x) = execute

`ls -l` - list permissions

`-rwxr-xr--` - how permissions are represented

- char 1: `-` for file or `d` for directory
- char 2-4: Owner permission
- char 5-7: Group permission
- char 8-10: Other permission

use `chmod` to adjust permission of owner, group, and other using single value for bits (4-2-1). 1,2,3,4,5,6,7

`chmod 700 file.txt` - rwx to owner, none all others

`chmod 760 file.txt` - rwx to owner, rw to group, none to others

`cgroups`

## Add or Set File Permissions

`chmod u+x test` - add execute perm to user

`chmod +x test` - adds execute perm to all

`chmod g+rw` - add read write perm to group

`chmod o-x` - remove execute perm from other

# Modify File or Dir

`mkdir <dir name>` - make a new dir

`rmdir <dir name>` - remove dir

`rm -fr <dir name>` - removes dir and all nested dirs and file - **CAUTION**

`mv <file> <dest/new name>` - move file to dest or rename it

`rm <file>` - remove file

`cp <source file> <destination>` - copie file or dir

# Important Environment Variables

`PATH` - Where we look for a particular command
`PS1` - What you see in shell

To set environment variable: `PS1="readytorun: "`

To print out environment variable `echo $PS1`

# OS

`uname` - List information on OS you are on

`systemd` - manages systems and services

`cat /etc/os-release` - Shows information about the current OS

`sudo apt upgrade` - install updates

`sudo apt full-upgrade` - will remove installed packages if that is needed to upgrade the whole system

`sudo apt install <package>` - install package

`sudo apt clean` - remove cached packages

`sudo apt autoclean` - To remove only outdated cached packages

`sudo apt remove <package>` - removes package

`apt autoremove` - removes package and dependencies

`sudo apt list` - list the available, installed, and upgradable packages

- `--installed` - add flag to show installed ones
- `--upgradeable` - add flag to show upgradable ones

## Logs

`journalctl` - view and manage system logs

Auth log shows all auth and login attempts is found at: `/var/log/auth.log`

`tail -f auth.log `- show last access

## Services

`systemctl <command> <service>` - manage services

### Commands

`start` - start a service

`stop` - stop a service

`enable` - enable auto-start at boot

`disable` - disable auto-start at boot

`status` - view status

`restart` - restart

`reload` - reload service config

# Network

`ip addr` - list info about network interface and IP

`arp -a`

`host <name>` - retrieves IP for given name

`hostname <name>` set the host name or get hostname of OS

`nmap` - network scanner

`ping hostname|ip` - ping host/ip address

`tcptraceroute hostname | ip` - find route on network

`tracepath hostname | ip` - find route

`nc host port` - can connect to service. nc = netcat

`wireshark` - packet analysis and capture

## IP Troubleshooting and Discovery

- `ping hostname|ip` - ping host/ip address
- `tcptraceroute hostname | ip` - find route on network
- `tracepath hostname | ip` - find route
- `nc host port` - can connect to service. nc = netcat
- whois `<host>` - find who owns domain

# SSH

# Misc. Useful Commands

`set` - list variables set

`man <COMMAND>` - shows manual for a command
