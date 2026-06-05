// ══════════════════════════════════════════════════════════════════════════════
// API Client Provider — Riverpod provider for the Supabase ApiClient
// ══════════════════════════════════════════════════════════════════════════════

import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'api_client.dart';

final apiClientProvider = Provider<ApiClientBase>((ref) {
  return ApiClient();
});
