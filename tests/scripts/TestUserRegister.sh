API_URL="http://127.0.0.1:8000/api/v1/register"

# Payload
DATA=$(cat <<EOF
{
  "name": "John Doe",
  "email": "john.doe@example.com",
  "password": "supersecretpassword123",
  "company": "AcmeCorp"
}
EOF
)

curl -X POST "$API_URL" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d "$DATA" | jq .
