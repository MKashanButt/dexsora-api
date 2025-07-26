API_URL="http://127.0.0.1:8000/api/v1/login"

# Payload
DATA=$(cat <<EOF
{
  "email": "john.doe@example.com",
  "password": "supersecretpassword123"
}
EOF
)

curl -X POST "$API_URL" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d "$DATA" | jq .
