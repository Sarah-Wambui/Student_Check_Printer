<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Check Printing</title>
    @vite('resources/css/app.css')
    <style>
        a{
            background-color: #E7A94B;
            color: #fff;
            border: none;
        }
    </style>
</head>
<body>
    <div class="home-page">
        <div class="min-h-screen bg-background">
            <!-- /* Hero Section */ -->
            <section class=" h-screen relative overflow-hidden bg-gradient-to-br from-primary/5 via-background to-accent/5 py-20 px-4">
                <div class="container mx-auto pt-24 lg:pt-32">
                    <div class="grid lg:grid-cols-2 gap-12 items-center pt-10">
                        <!-- /* Left side - Text content */ -->
                        <div class="text-left space-y-6">
                            <h1 class="text-5xl font-bold md:text-6xl lg:text-7xl text-foreground">
                                Check Printing System
                            </h1>
                            <p class="text-xl md:text-2xl text-muted-foreground">
                                Manage your budget and print checks securely all in one place
                            </p>
                            <div class="pt-4">
                                <a href="/user/login" class="text-white text-lg font-bold py-6 px-10 rounded-md shadow-md transition-all">Login</a>
                            </div>
                        </div>
                        
                        <!-- /* Right side - Hero Image */ -->
                        <div class="relative">
                            <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                                <img 
                                    src="{{ asset('assets/hero-image.jpg') }}"
                                    class="w-full h-auto object-cover"
                                    alt="Student check printing system dashboard preview"
                                />

                            </div>
                            <!-- /* Decorative elements */ -->
                            <div class="absolute -top-4 -right-4 w-24 h-24 bg-primary/20 rounded-full blur-3xl" />
                            <div class="absolute -bottom-4 -left-4 w-32 h-32 bg-accent/20 rounded-full blur-3xl" />
                        </div>
                    </div>
                </div>
            </section>

            <!-- /* Features Section */ -->
            <!-- <section class="py-20 px-4">
                <div class="container mx-auto max-w-6xl">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold mb-4">How It Works</h2>
                    <p class="text-xl text-muted-foreground">
                    Simple, secure check printing for students
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    {features.map((feature, index) => (
                    <Card key={index} class="border-border hover:shadow-lg transition-shadow">
                        <CardContent class="pt-6">
                        <div class="mb-4 inline-flex p-3 rounded-lg bg-primary/10">
                            <feature.icon class="h-6 w-6 text-primary" />
                        </div>
                        <h3 class="text-xl font-semibold mb-2">{feature.title}</h3>
                        <p class="text-muted-foreground">{feature.description}</p>
                        </CardContent>
                    </Card>
                    ))}
                </div>
                </div>
            </section> -->

            <!-- /* CTA Section */ -->
            <!-- <section class="py-20 px-4 bg-secondary">
                <div class="container mx-auto max-w-4xl text-center">
                <h2 class="text-4xl font-bold mb-4">Ready to Get Started?</h2>
                <p class="text-xl text-muted-foreground mb-8">
                    Sign up today and start managing your check printing needs
                </p>
                <Link to="/auth">
                    <Button size="lg" class="text-lg px-8">
                    Create Your Account
                    </Button>
                </Link>
                </div>
            </section> -->

            <!-- /* Footer */ -->
            <!-- <footer class="py-8 px-4 border-t border-border">
                <div class="container mx-auto max-w-6xl text-center text-muted-foreground">
                <p>&copy; 2025 Student Check Printing System. All rights reserved.</p>
                </div>
            </footer> -->
        </div>
    </div>
</body>
</html>