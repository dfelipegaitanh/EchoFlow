---
trigger: always_on
description: 
globs: 
---

# MUST DO WHEN CREATE A UNIT TEST

- Use JEST for any typescript code
- Use PEST for any PHP code
- Never use PHPUnit

# Testing Practices

- ** Always ** Write unit tests for business logic if needed.
- ** Always ** Write feature tests for integration and end-to-end testing if needed.

## Explanation

- Tests ensure code correctness and prevent regressions.
- Unit tests focus on business logic without external dependencies.
- Integration tests verify that components work together correctly.