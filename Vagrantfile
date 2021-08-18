# Vagrant File for BZTF Module M151 - a VM to run docker inside with some services.
# (c) Alexander Schenkel, alex@alexi.ch

# -*- mode: ruby -*-
# vi: set ft=ruby :

# BZT Modulname (z.B. "m151"). Daraus werden dann VMs und User ersellt, also bitte keine Spaces, sonderzeichen etc.
bzt_modulname = "m151"

Vagrant.configure("2") do |config|
  # The most common configuration options are documented and commented below.
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  # Every Vagrant development environment requires a box. You can search for
  # boxes at https://vagrantcloud.com/search.
  config.vm.box = "hashicorp/bionic64"
  config.vm.hostname = bzt_modulname + "vm"

  # use a public network bridge with a DHCP ip:
  # config.vm.network "public_network"

  # or use a private network for host-only communication:
  # config.vm.network "private_network", ip: "10.10.10.10"

  # or use a private network, and map the needed ports:
  # docker port 8020: web server
  # config.vm.network "forwarded_port", guest: 8020, host: 8020
  # docker port 8030: websocket server
  # config.vm.network "forwarded_port", guest: 8030, host: 8030
  # docker port 10000: docsify
  # config.vm.network "forwarded_port", guest: 10000, host: 10000
  # docker port 35729: live reload
  # config.vm.network "forwarded_port", guest: 35729, host: 35729
  # docker port 8080: PlantUML
  # config.vm.network "forwarded_port", guest: 10001, host: 10001
  # docker port 3306: MySQL server
  # config.vm.network "forwarded_port", guest: 3306, host: 3306

  # config.vm.synced_folder ".", "/vagrant"
  # for mysql to work correctly, we need to mount the db data dir writable for all:
  # config.vm.synced_folder "./db-data", "/vagrant/db-data", create: true, mount_options:["dmode=0777", "fmode=0777"]

  config.vm.provider "virtualbox" do |vb, override|
    vb.gui = true
    vb.name = bzt_modulname + "vm"
    vb.memory = 2048
    vb.cpus = 2

    config.vm.network "private_network", ip: "10.10.10.10"

    vb.customize ["modifyvm", :id, "--vram", "32"]
    vb.customize ["modifyvm", :id, "--graphicscontroller", "vmsvga"]
    vb.customize ["modifyvm", :id, "--ioapic", "on"]
    vb.customize ["modifyvm", :id, "--rtcuseutc", "off"]
    vb.customize ["modifyvm", :id, "--accelerate3d", "off"]
    vb.customize ["modifyvm", :id, "--clipboard", "bidirectional"]
    vb.customize ["modifyvm", :id, "--draganddrop", "bidirectional"]
    vb.customize ["modifyvm", :id, "--paravirtprovider", "kvm"]

    config.vm.provision "ansible_local" do |ansible|
        ansible.playbook = "provisioning/ansible-playbook.yml"
        ansible.galaxy_role_file = "provisioning/ansible-galaxy-requirements.yml"
        ansible.extra_vars = {
          vagrant_provider: "virtualbox",
          student_user: bzt_modulname
        }
    end
  end

  config.vm.provider "vmware_desktop" do |vb, override|
    vb.gui = true
    vb.memory = 2048
    vb.cpus = 2

    # config.vm.network "forwarded_port", guest: 8020, host: 8020
    # config.vm.network "private_network", ip: "10.10.10.10"

    config.vm.provision "ansible_local" do |ansible|
        ansible.playbook = "provisioning/ansible-playbook.yml"
        ansible.galaxy_role_file = "provisioning/ansible-galaxy-requirements.yml"
        ansible.extra_vars = {
          vagrant_provider: "vmware",
          student_user: bzt_modulname
        }
    end
  end
end
