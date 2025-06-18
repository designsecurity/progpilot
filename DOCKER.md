# Docker Usage

This document explains how to use progpilot with Docker.

## Building the Docker Image

```bash
docker build -t progpilot .
```

## Usage

### Basic Usage

```bash
# Analyze a single PHP file
docker run -v $(pwd):/workspace progpilot /workspace/path/to/your/file.php

# Analyze multiple files
docker run -v $(pwd):/workspace progpilot /workspace/file1.php /workspace/file2.php /workspace/file3.php

# Analyze a directory
docker run -v $(pwd):/workspace progpilot /workspace/path/to/your/php/project/

# Use with configuration file
docker run -v $(pwd):/workspace progpilot /workspace/file.php --configuration /workspace/config.yml
```

### Examples

```bash
# Analyze current directory (mount current directory)
docker run -v $(pwd):/workspace progpilot /workspace/

# Analyze with custom configuration
docker run -v $(pwd):/workspace progpilot /workspace/ --configuration /workspace/progpilot.yml

# Analyze specific files in current directory
docker run -v $(pwd):/workspace progpilot /workspace/index.php /workspace/config.php

# Test with the example file
docker run -v $(pwd):/workspace progpilot /workspace/projects/example/source_code1.php
```

## Volume Mounting

Since the container needs access to your PHP files, you'll need to mount volumes:

- `-v $(pwd):/workspace`: Mount your current directory to `/workspace` in the container
- Use absolute paths inside the container for the files/directories you want to analyze
- The `/workspace` path inside the container corresponds to your current directory

## Configuration Files

If you're using a configuration file, make sure to:
1. Mount the directory containing your config file
2. Use the container path when referencing the config file

## Notes

- The container builds the progpilot phar file during the build process
- All arguments passed to the container are forwarded to the progpilot command
- The container uses PHP 8.1 which is compatible with the project requirements (>=7.4)
- Make sure to use the correct file paths when mounting volumes 