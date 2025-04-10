# TALL Stack Starter Kit

A modern, opinionated Laravel starter kit with a focus on clean architecture, type safety, and developer experience.

## Tech Stack

- **PHP**: 8.4.x
- **Laravel**: 12.x
- **Tailwind CSS**: 4.x
- **Livewire**: 3.x
- **FluxUI**: 2.x
- **PestPHP**: 3.8.x

## Features

- 🚀 Modern PHP 8.4 features (readonly, final, enum, match, promoted properties)
- 🧪 100% test coverage with PestPHP
- 🎨 Beautiful UI with Tailwind CSS and FluxUI
- ⚡ Real-time components with Livewire
- 🔒 Type-safe code with strict types
- 📦 Clean architecture with Actions and DTOs
- 🌐 Built-in translation support
- 🛡️ Security best practices

## Requirements

- PHP 8.4
- Composer
- Node.js 18+
- Herd (for local development)

## Installation

1. Clone the repository:
```bash
git clone https://github.com/your-org/starter-kit.git
cd starter-kit
```

2. Install PHP dependencies:
```bash
herd composer install
```

3. Install NPM dependencies:
```bash
npm install
```

4. Copy environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
herd artisan key:generate
```

6. Run migrations:
```bash
herd artisan migrate
```

7. Start the development server:
```bash
herd artisan serve
```

## Development Workflow

1. Write tests first:
```bash
herd composer test:type-coverage
herd composer test:typos
herd coverage ./vendor/bin/pest --coverage --exactly=100.0
```

2. Run static analysis:
```bash
herd composer analyse
```

3. Fix code style:
```bash
herd composer fix
```

## Architecture

### Models
- Located in `app/Models`
- Always `final`
- No `$fillable` or `$guarded`
- Use DTOs and Actions for data manipulation
- All properties must be documented with PHPDoc

### Actions
- Located in `app/Actions`
- `final` classes with a `handle()` method
- Single Responsibility Principle
- Use DTOs for input/output
- DTOs are readonly and immutable
- Use Collections over arrays
- Use Value Objects when applicable

### Livewire Pages
- Located in `app/Livewire`
- Full-page components only
- Feature-based folder structure
- Delegate logic to Actions
- Minimal Blade usage

## Testing

- Every public method and Action must have a test
- Use PestPHP for all tests
- Test directory structure is predefined
- 100% test coverage required

## Styling

- Tailwind CSS 4.x only
- FluxUI 2.x components preferred
- Minimal custom CSS
- Responsive and accessible (a11y)
- Use `Flux::toast()` for flash messages
- All text must be wrapped in `__()` for translation

## Best Practices

1. All classes must be `final`
2. Avoid global helpers
3. Isolate all logic
4. Keep code simple and maintainable
5. Follow SOLID principles
6. Use immutability and pure functions
7. No "quick fixes" - refactor properly

## Code Review Policy

- Code must be clean, tested, and follow this guide
- No hacks or improper solutions
- No code without test coverage
- No code without proper structure

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details. 