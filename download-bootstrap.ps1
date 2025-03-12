# Create directories if they don't exist
New-Item -ItemType Directory -Force -Path "public\css"
New-Item -ItemType Directory -Force -Path "public\js"

# Download Bootstrap CSS
Invoke-WebRequest -Uri "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" -OutFile "public\css\bootstrap.min.css"

# Download Bootstrap JS Bundle
Invoke-WebRequest -Uri "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" -OutFile "public\js\bootstrap.bundle.min.js"

Write-Host "Bootstrap files downloaded successfully!" 