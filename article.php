<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>China Travel 101: Essential Prep Before You Go | China Travel Starter Pack</title>
    <meta name="description" content="Your complete guide to preparing for travel in China - payments, apps, internet access and cultural tips for foreign visitors.">
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0..1,0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <style>
        /* Article Header */
        .article-header {
            padding-block: 40px 20px;
            position: relative;
            overflow: hidden;
            background-color: var(--neutral-100);
        }
        
        .article-header .container {
            position: relative;
            z-index: 2;
        }
        
        .article-hero-img {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: var(--radius-large);
            margin-bottom: 24px;
            box-shadow: var(--shadow-4);
        }
        
        .article-title {
            font-size: var(--fs-headline-large);
            line-height: var(--lh-headline-large);
            margin-bottom: 24px;
            color: var(--neutral-10);
        }
        
        .article-meta {
            display: flex;
            align-items: center;
            gap: 24px;
            margin-bottom: 32px;
        }
        
        .article-meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--neutral-50);
        }
        
        .article-meta-icon {
            font-size: 20px;
        }
        
        /* Article Content */
        .article-content {
            padding-block: 40px;
            background-color: var(--neutral-100);
        }
        
        .article-section {
            margin-bottom: 48px;
        }
        
        .article-section-title {
            font-size: var(--fs-headline-medium);
            line-height: var(--lh-headline-medium);
            margin-bottom: 24px;
            color: var(--neutral-10);
            position: relative;
            padding-bottom: 12px;
        }
        
        .article-section-title::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 4px;
            background-color: var(--primary-100);
            border-radius: 2px;
        }
        
        .article-text {
            font-size: var(--fs-body-large);
            line-height: var(--lh-body-large);
            color: var(--neutral-30);
            margin-bottom: 24px;
        }
        
        .article-tip {
            background-color: var(--neutral-98);
            border-left: 4px solid var(--primary-100);
            padding: 20px;
            border-radius: 0 var(--radius-medium) var(--radius-medium) 0;
            margin: 32px 0;
        }
        
        .article-tip-title {
            font-weight: var(--weight-semiBold);
            color: var(--primary-100);
            margin-bottom: 12px;
        }
        
        .article-checklist {
            display: grid;
            gap: 16px;
            margin: 32px 0;
        }
        
        .checklist-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }
        
        .checklist-icon {
            color: var(--primary-100);
            font-size: 24px;
            flex-shrink: 0;
        }
        
        .checklist-content {
            flex: 1;
        }
        
        .checklist-title {
            font-weight: var(--weight-semiBold);
            color: var(--neutral-20);
            margin-bottom: 4px;
        }
        
        .checklist-text {
            color: var(--neutral-40);
        }
        
        .article-image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 16px;
            margin: 32px 0;
        }
        
        .article-image {
            border-radius: var(--radius-medium);
            overflow: hidden;
            box-shadow: var(--shadow-2);
        }
        
        .article-image img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            display: block;
        }
        
        .article-image-caption {
            text-align: center;
            font-size: var(--fs-label-medium);
            color: var(--neutral-50);
            margin-top: 8px;
        }
        
        .article-cta {
            background-color: var(--neutral-98);
            border-radius: var(--radius-large);
            padding: 40px;
            text-align: center;
            margin-top: 60px;
        }
        
        .article-cta-title {
            font-size: var(--fs-title-large);
            margin-bottom: 16px;
            color: var(--neutral-20);
        }
        
        .article-cta-text {
            margin-bottom: 24px;
            color: var(--neutral-40);
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        /* Responsive Design */
        @media (max-width: 1024px) {
            .article-title {
                font-size: var(--fs-headline-medium);
                line-height: var(--lh-headline-medium);
            }
            
            .article-hero-img {
                max-height: 400px;
            }
            
            .article-section-title {
                font-size: var(--fs-title-large);
            }
            
            .article-image-grid {
                grid-template-columns: 1fr;
            }
            
            .article-cta {
                padding: 32px;
            }
        }
        
        @media (max-width: 768px) {
            .article-header {
                padding-block: 20px 10px;
            }
            
            .article-title {
                font-size: var(--fs-title-large);
                line-height: var(--lh-title-large);
            }
            
            .article-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            
            .article-hero-img {
                max-height: 300px;
                border-radius: var(--radius-medium);
            }
            
            .article-content {
                padding-block: 20px;
            }
            
            .article-section-title {
                font-size: var(--fs-title-medium);
                line-height: var(--lh-title-medium);
            }
            
            .article-text {
                font-size: var(--fs-body-medium);
                line-height: var(--lh-body-medium);
            }
            
            .article-tip {
                padding: 16px;
            }
            
            .checklist-icon {
                font-size: 20px;
            }
            
            .article-cta {
                padding: 24px;
            }
            
            .article-cta-title {
                font-size: var(--fs-title-medium);
            }
        }
        
        @media (max-width: 480px) {
            .article-title {
                font-size: var(--fs-title-medium);
            }
            
            .article-hero-img {
                max-height: 200px;
            }
            
            .article-section {
                margin-bottom: 32px;
            }
            
            .article-section-title {
                font-size: var(--fs-title-small);
            }
            
            .article-text {
                font-size: var(--fs-body-small);
            }
            
            .article-cta {
                padding: 20px;
            }
            
            .btn {
                padding: 12px 20px;
            }
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'sidebar.php'; ?>
    
    <div class="main-content">
        <main>
            <!-- Article Header -->
            <header class="article-header">
                <div class="container">
                    <img src="./assets/images/feature-banner-1.jpg" alt="Traveler using smartphone in China" class="article-hero-img">
                    <h1 class="article-title">China Travel 101: Essential Prep Before You Go</h1>
                    <div class="article-meta">
                        <div class="article-meta-item">
                            <span class="material-symbols-rounded article-meta-icon">calendar_today</span>
                            <span class="body-large">Updated: May 10, 2025</span>
                        </div>
                        <div class="article-meta-item">
                            <span class="material-symbols-rounded article-meta-icon">schedule</span>
                            <span class="body-large">15 min read</span>
                        </div>
                    </div>
                    <p class="body-large hero-text">
                        Your must-know checklist to avoid surprises and travel China like a savvy explorer.
                    </p>
                </div>
            </header>
            
            <!-- Article Content -->
            <article class="article-content">
                <div class="container">
                    <section class="article-section">
                        <p class="article-text">
                            Traveling to China is an incredible experience—from the Great Wall's majesty to Shanghai's futuristic skyline. But unlike many destinations, China has some unique requirements that can trip up unprepared visitors. After helping thousands of travelers with their China trips, we've compiled this essential prep checklist to ensure your adventure goes smoothly.
                        </p>
                        
                        <div class="article-tip">
                            <h3 class="article-tip-title">Pro Tip</h3>
                            <p class="article-text">
                                Start these preparations at least 2-3 weeks before your trip. Some steps (like visa applications) can take time!
                            </p>
                        </div>
                    </section>
                    
                    <section class="article-section">
                        <h2 class="article-section-title">1. Cash & Payments</h2>
                        
                        <p class="article-text">
                            China's payment ecosystem is unique—while cash is still accepted, mobile payments dominate daily life. Here's how to navigate money matters:
                        </p>
                        
                        <div class="article-checklist">
                            <div class="checklist-item">
                                <span class="material-symbols-rounded checklist-icon">check_circle</span>
                                <div class="checklist-content">
                                    <h3 class="checklist-title">Cash is still king (sometimes)</h3>
                                    <p class="checklist-text">
                                        While mobile payments are everywhere, always carry some RMB (Chinese Yuan) in cash. Small vendors, taxis, and rural areas may not accept digital payments. Exchange currency at banks or authorized exchange counters for the best rates.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="checklist-item">
                                <span class="material-symbols-rounded checklist-icon">check_circle</span>
                                <div class="checklist-content">
                                    <h3 class="checklist-title">Set up Alipay Tour Pass</h3>
                                    <p class="checklist-text">
                                        Foreigners can now use Alipay's "Tour Pass" feature, which lets you load money onto the app using an international credit card. This gives you access to millions of merchants across China without needing a Chinese bank account.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="checklist-item">
                                <span class="material-symbols-rounded checklist-icon">check_circle</span>
                                <div class="checklist-content">
                                    <h3 class="checklist-title">Notify your bank</h3>
                                    <p class="checklist-text">
                                        Inform your bank about your travel plans to avoid card blocks. China's UnionPay network is widely accepted, but Visa/Mastercard work mostly at hotels and upscale restaurants.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="article-image-grid">
                            <figure class="article-image">
                                <img src="./assets/images/alipay-demo.jpg" width="280" height="200" alt="Alipay Tour Pass interface">
                                <figcaption class="article-image-caption">Alipay's Tour Pass feature for foreign visitors</figcaption>
                            </figure>
                            <figure class="article-image">
                                <img src="./assets/images/cash-exchange.jpg" width="280" height="200" alt="Exchanging currency in China">
                                <figcaption class="article-image-caption">Currency exchange counter in Beijing</figcaption>
                            </figure>
                        </div>
                    </section>
                    
                    <section class="article-section">
                        <h2 class="article-section-title">2. Must-Have Apps</h2>
                        
                        <p class="article-text">
                            China's digital ecosystem is largely separate from the global internet. These apps will be your lifeline during your trip:
                        </p>
                        
                        <div class="article-checklist">
                            <div class="checklist-item">
                                <span class="material-symbols-rounded checklist-icon">check_circle</span>
                                <div class="checklist-content">
                                    <h3 class="checklist-title">WeChat (微信)</h3>
                                    <p class="checklist-text">
                                        The Swiss Army knife of Chinese apps—messaging, payments, mini-programs, and more. Essential for communicating with hotels, guides, and new friends. Download and set up before you leave.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="checklist-item">
                                <span class="material-symbols-rounded checklist-icon">check_circle</span>
                                <div class="checklist-content">
                                    <h3 class="checklist-title">DiDi (滴滴出行)</h3>
                                    <p class="checklist-text">
                                        China's Uber equivalent. The English version works with international credit cards. Much easier than hailing taxis, especially if you don't speak Chinese.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="checklist-item">
                                <span class="material-symbols-rounded checklist-icon">check_circle</span>
                                <div class="checklist-content">
                                    <h3 class="checklist-title">Pleco (词典)</h3>
                                    <p class="checklist-text">
                                        The best Chinese-English dictionary app. The OCR feature lets you point your camera at text for instant translation—invaluable for menus and signs.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="checklist-item">
                                <span class="material-symbols-rounded checklist-icon">check_circle</span>
                                <div class="checklist-content">
                                    <h3 class="checklist-title">MetroMan China</h3>
                                    <p class="checklist-text">
                                        Offline subway maps and route planners for all major Chinese cities. Much more reliable than trying to use Google Maps (which doesn't work well in China).
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="article-tip">
                            <h3 class="article-tip-title">App Store Tip</h3>
                            <p class="article-text">
                                Download these apps before you arrive using your home country's app store. Some may be harder to find or require Chinese payment methods if you try to download them in China.
                            </p>
                        </div>
                    </section>
                    
                    <section class="article-section">
                        <h2 class="article-section-title">3. Internet & SIM Cards</h2>
                        
                        <p class="article-text">
                            China's internet landscape is unique, with many Western services blocked. Here's how to stay connected:
                        </p>
                        
                        <div class="article-checklist">
                            <div class="checklist-item">
                                <span class="material-symbols-rounded checklist-icon">check_circle</span>
                                <div class="checklist-content">
                                    <h3 class="checklist-title">Get a local SIM card</h3>
                                    <p class="checklist-text">
                                        Purchase at the airport upon arrival (China Mobile/China Unicom). You'll need your passport for registration. Data is cheap—about 100RMB ($15) for 10GB valid for 30 days.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="checklist-item">
                                <span class="material-symbols-rounded checklist-icon">check_circle</span>
                                <div class="checklist-content">
                                    <h3 class="checklist-title">Set up a VPN beforehand</h3>
                                    <p class="checklist-text">
                                        Services like Google, Facebook, WhatsApp and many Western news sites are blocked. Install a reliable VPN (ExpressVPN, NordVPN, Astrill) on all your devices before arrival.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="checklist-item">
                                <span class="material-symbols-rounded checklist-icon">check_circle</span>
                                <div class="checklist-content">
                                    <h3 class="checklist-title">Prepare for Wi-Fi logins</h3>
                                    <p class="checklist-text">
                                        Many public Wi-Fi networks require a Chinese phone number to receive a verification code. Hotels usually provide Wi-Fi without this requirement.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>
                    
                    <section class="article-section">
                        <h2 class="article-section-title">4. Cultural Prep</h2>
                        
                        <p class="article-text">
                            Understanding a few cultural norms will make your trip smoother and more enjoyable:
                        </p>
                        
                        <div class="article-checklist">
                            <div class="checklist-item">
                                <span class="material-symbols-rounded checklist-icon">check_circle</span>
                                <div class="checklist-content">
                                    <h3 class="checklist-title">Learn basic Mandarin phrases</h3>
                                    <p class="checklist-text">
                                        While you can get by with apps, knowing hello (你好 nǐ hǎo), thank you (谢谢 xiè xie), and "how much?" (多少钱 duō shǎo qián) goes a long way.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="checklist-item">
                                <span class="material-symbols-rounded checklist-icon">check_circle</span>
                                <div class="checklist-content">
                                    <h3 class="checklist-title">Carry toilet paper & hand sanitizer</h3>
                                    <p class="checklist-text">
                                        Many public restrooms (especially outside hotels) don't provide toilet paper. A small pack of tissues and sanitizer will save you in a pinch.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="checklist-item">
                                <span class="material-symbols-rounded checklist-icon">check_circle</span>
                                <div class="checklist-content">
                                    <h3 class="checklist-title">Prepare for the squat toilet</h3>
                                    <p class="checklist-text">
                                        While Western-style toilets are common in hotels, many public places have squat toilets. Practice your stance if you're not familiar!
                                    </p>
                                </div>
                            </div>
                            
                            <div class="checklist-item">
                                <span class="material-symbols-rounded checklist-icon">check_circle</span>
                                <div class="checklist-content">
                                    <h3 class="checklist-title">Understand personal space norms</h3>
                                    <p class="checklist-text">
                                        Chinese cities are crowded, and personal space expectations differ. Don't be surprised by closer physical proximity in lines or public transport.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="article-image-grid">
                            <figure class="article-image">
                                <img src="./assets/images/chinese-phrases.jpg" width="280" height="200" alt="Common Chinese phrases for travelers">
                                <figcaption class="article-image-caption">Essential Mandarin phrases to learn</figcaption>
                            </figure>
                            <figure class="article-image">
                                <img src="./assets/images/china-toilet.jpg" width="280" height="200" alt="Squat toilet in China">
                                <figcaption class="article-image-caption">Be prepared for different restroom facilities</figcaption>
                            </figure>
                        </div>
                    </section>
                    
                    <section class="article-section">
                        <h2 class="article-section-title">5. Final Checklist Before Departure</h2>
                        
                        <div class="article-checklist">
                            <div class="checklist-item">
                                <span class="material-symbols-rounded checklist-icon">checklist</span>
                                <div class="checklist-content">
                                    <h3 class="checklist-title">Passport & Visa</h3>
                                    <p class="checklist-text">
                                        Ensure your passport has at least 6 months validity and blank pages. Apply for your Chinese visa well in advance.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="checklist-item">
                                <span class="material-symbols-rounded checklist-icon">checklist</span>
                                <div class="checklist-content">
                                    <h3 class="checklist-title">Prescription medications</h3>
                                    <p class="checklist-text">
                                        Bring adequate supplies in original packaging with prescriptions. Some medications available elsewhere are controlled in China.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="checklist-item">
                                <span class="material-symbols-rounded checklist-icon">checklist</span>
                                <div class="checklist-content">
                                    <h3 class="checklist-title">Power adapters</h3>
                                    <p class="checklist-text">
                                        China uses Type A, C, and I plugs (220V). Bring universal adapters if your devices don't support these.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="checklist-item">
                                <span class="material-symbols-rounded checklist-icon">checklist</span>
                                <div class="checklist-content">
                                    <h3 class="checklist-title">Printed backups</h3>
                                    <p class="checklist-text">
                                        Print copies of your hotel addresses in Chinese characters, important phone numbers, and emergency contacts.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>
                    
                    <div class="article-cta">
                        <h3 class="article-cta-title">Ready to Explore China?</h3>
                        <p class="article-cta-text">
                            Now that you're prepared, it's time to start planning your adventure! Use our city guides to discover the best attractions, food, and hidden gems across China.
                        </p>
                        <a href="cities.php" class="btn btn-fill">
                            <span class="label-medium">Browse City Guides</span>
                            <span class="material-symbols-rounded" aria-hidden="true">arrow_outward</span>
                        </a>
                    </div>
                </div>
            </article>
        </main>
        
        <?php include 'footer.php'; ?>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add any necessary JavaScript here
        });
    </script>
</body>
</html>