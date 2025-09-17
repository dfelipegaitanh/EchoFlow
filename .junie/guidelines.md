# Development Guidelines

This document outlines the development guidelines for this project. It includes information about code style, development practices, and testing.

## Development Information

### DRY (Don't Repeat Yourself)

Avoid code duplication. Centralize logic in reusable functions or classes.

### KISS (Keep It Simple, Stupid)

Keep code as simple and straightforward as possible. Avoid over-engineered or unnecessarily complex solutions.

### YAGNI (You Aren't Gonna Need It)

Don't implement features that haven't been requested or aren't currently necessary.

### LOD (Law of Demeter)

Design code so that objects only communicate with their immediate collaborators, avoiding long call chains.

### SRP (Single Responsibility Principle)

Each class, module, or function should have a single, clearly defined responsibility.

### OCP (Open/Closed Principle)

Code should be open for extension but closed for modification: new functionality can be added without altering existing code.

### LSP (Liskov Substitution Principle)

Subclasses or implementations should be replaceable for their base types without breaking expected behavior.

### ISP (Interface Segregation Principle)

Prefer small, specific interfaces over large, general ones. Avoid forcing clients to implement methods they don't use.

### DIP (Dependency Inversion Principle)

High-level modules should depend on abstractions (e.g., interfaces) rather than low-level modules. This makes swapping dependencies easier without modifying business logic.

## Effective Testing

### Testing Practices

- ** Always ** Write unit tests for business logic if needed.
- ** Always ** Write feature tests for integration and end-to-end testing if needed.
- For typescript, use jest and for php use pest

#### Explanation

- Tests ensure code correctness and prevent regressions.
- Unit tests focus on business logic without external dependencies.
- Integration tests verify that components work together correctly.

## Additional Rules for JavaScript and TypeScript

- ✅ Apply modern JavaScript conventions (ES6+), using `const` and `let` instead of `var`.
- ✅ Use arrow functions (`=>`) where clearer and appropriate.
- ✅ Use destructuring to improve readability.
- ✅ Add short, explanatory, and relevant comments.
- ✅ Follow best practices like modularizing your code into separate files and using `import/export` when appropriate.
- ✅ Prioritize readability and maintainability over premature optimization.
- ✅ Use SOLID principles.

## Additional Rules for PHP

- ✅ Follow PSR-12 as the coding style standard.
- ✅ Use strict typing (`declare(strict_types=1)`).
- ✅ Prefer namespaces and autoloading with Composer.
- ✅ Avoid global functions; prefer classes or pure functions.
- ✅ Use PHPDoc to document methods and classes.
- ✅ Prioritize dependency injection over direct instantiation.
- ✅ Apply good security practices (e.g., input filtering and sanitization).
- ✅ Always use DTOs.
- ✅ Use SOLID principles.

## Git Workflow Process

When starting work on a new feature or bug fix, follow these steps:

- Create a new Git branch before starting any work.
- Record the session start timestamp in yyyy-MM-dd_hh-mm format.
- Before writing any code, create a file named .plans/plan-{timestamp}.md (replace {timestamp} with your recorded value).
- In that file, write your detailed, numbered task list.
- Save that list to a separate file named .tasks/tasks-{timestamp}.md.
- Do the work specified by the user's prompt.
- After finishing each task, mark it as done (✓) in tasks-{timestamp}.md.
- When all tasks are complete, commit your changes to the new branch.

## Documentation of Critical Enhancements

When making significant changes to the codebase, especially to critical components or core functionality, follow these guidelines:

### What to Document

- **Architectural Changes**: Any modifications to the system's architecture, design patterns, or structural components.
- **Core Algorithm Improvements**: Significant optimizations or changes to core algorithms that affect performance, security, or functionality.
- **New Design Patterns**: Introduction of new design patterns or programming paradigms.
- **Breaking Changes**: Any changes that are not backward compatible or require updates to dependent code.
- **Security Enhancements**: Important security improvements or vulnerability fixes.
- **Performance Optimizations**: Significant performance improvements that change how the system operates.

### Where to Document

#### **For Critical Enhancements**:

- Update this guidelines document with a brief description of the enhancement
- Include the rationale behind the change
- Document any new patterns or approaches that other developers should follow
- Add examples if the enhancement introduces new coding patterns
- Place detailed enhancement documentation files in the `.enhancements` directory

#### **For Bug Fixes**:

- For significant bug fixes that affect core functionality or behavior
- Document the root cause of the bug and the solution implemented
- Include any lessons learned that might prevent similar bugs
- If the fix introduces a new pattern or approach, document it here
- Place detailed bug documentation files in the `.bugs` directory
- The file must have a timestamp in yyyy-MM-dd_hh-mm format at the end, example: `bugfix-2023-01-01_12-34.md`.

#### **For New Features**:

- If the feature introduces new development patterns, add them to this guidelines document
- For features that require specific usage patterns, include examples
- Document any non-obvious design decisions that future developers should understand
- Place detailed feature documentation files in the `.features` directory
- The file must have a timestamp in yyyy-MM-dd_hh-mm format at the end, example: `feature-2023-01-01_12-34.md`.

### Documentation Format

When adding documentation to this guidelines document:

- Use clear, concise language
- Include code examples where appropriate
- Explain the "why" behind the change, not just the "what"
- Reference related documentation or external resources when relevant
- Organize information under appropriate headings

## Additional Guidelines

- Use consistent naming conventions for variables, functions, and classes.
- Avoid using global variables and functions.
- Use meaningful variable and function names that reflect their purpose.
- Avoid using magic numbers in your code.
- Use comments to explain the purpose of each line of code.
- Avoid hard-coded values in your code.
- Use consistent spacing and indentation.
- Use descriptive variable names that reflect their purpose.
- Use meaningful variable and function names that reflect their purpose.
