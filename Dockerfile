# Use PHP 8.1 as base image (compatible with >=7.4 requirement)
FROM php:8.1-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    wget \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install phar-composer tool
RUN wget -O /usr/local/bin/phar-composer.phar https://github.com/clue/phar-composer/releases/download/v1.4.0/phar-composer-1.4.0.phar \
    && chmod +x /usr/local/bin/phar-composer.phar

# Set working directory
WORKDIR /app

# Copy project files
COPY . .

# Build the phar file
RUN chmod +x build.sh \
    && ./build.sh

# Create a simple entrypoint script
RUN echo '#!/bin/bash\n\
    if [ $# -eq 0 ]; then\n\
    echo "Usage: docker run progpilot <path1> [path2] [path3] ..."\n\
    echo "Example: docker run progpilot /path/to/php/files/ --configuration config.yml"\n\
    exit 1\n\
    fi\n\
    \n\
    # Find the latest built phar file\n\
    PHAR_FILE=$(ls -t builds/progpilot_*.phar 2>/dev/null | head -1)\n\
    \n\
    if [ ! -f "$PHAR_FILE" ]; then\n\
    echo "Error: No phar file found in builds directory"\n\
    exit 1\n\
    fi\n\
    \n\
    # Execute progpilot with all arguments\n\
    php "$PHAR_FILE" "$@"' > /entrypoint.sh \
    && chmod +x /entrypoint.sh

# Set the entrypoint
ENTRYPOINT ["/entrypoint.sh"]

# Default command (will show usage if no arguments provided)
CMD [] 